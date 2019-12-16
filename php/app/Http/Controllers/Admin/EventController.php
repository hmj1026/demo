<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Repositories\EventRepository;

use App\Presenters\StatusPresenter;

class EventController extends Controller
{
    private $statusPresenter;

    public function __construct(
        EventRepository $event,
        StatusPresenter $statusPresenter)
    {
        $this->event = $event;
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.event.list'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = ['content_header' => '創建活動內容', 'can_edit' => true];

        return view('admin.event.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only(['coupon', 'content', 'started_at', 'expired_at', 'status']);
        Validator::make($params, [
            'coupon' => 'required',
            'content.description' => 'required',
            'content.products' => 'required',
            'started_at' => 'required|date',
            'expired_at' => 'required|date',
            'status' => 'required',
        ])->validate();

        try {
            Event::insert([
                'coupon' => $request->coupon,
                'content' => \json_encode($request->content, JSON_UNESCAPED_UNICODE),
                'started_at' => Carbon::createFromFormat('Y-m-d H:i', $request->started_at),
                'expired_at' => Carbon::createFromFormat('Y-m-d H:i', $request->expired_at),
                'comment' => $request->comment,
                'status' => $request->status,
            ]);

            return back()->with(['message' => '新增活動成功', 'class' => 'success']);
        } catch (\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $admin = auth()->guard('admin')->user();
        $data = Event::where('id', $event->id)->first();
        
        $isEditadle = $admin->can('update', $data);
        $options = ['content_header' => '活動內容', 'can_edit' => $isEditadle];
        
        return view('admin.event.detail', compact('data', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $params = $request->only(['coupon', 'content', 'started_at', 'expired_at', 'status']);
        Validator::make($params, [
            'coupon' => 'required',
            'content.description' => 'required',
            'content.products' => 'required',
            'started_at' => 'required|date',
            'expired_at' => 'required|date',
            'status' => 'required',
        ])->validate();
        
        try {
            $params['content'] = \json_encode($params['content'], JSON_UNESCAPED_UNICODE);
            $params['started_at'] = Carbon::createFromFormat('Y-m-d H:i', $params['started_at']);
            $params['expired_at'] = Carbon::createFromFormat('Y-m-d H:i', $params['expired_at']);
            
            Event::where('id', $event->id)->update($params);

            return back()->with(['message' => '更新活動成功', 'class' => 'success']);
        } catch(\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger'])->withInput();
        }
    }

    public function getCategoriesData(Request $request)
    {
        $categories = [
            [
                'text' => '商用',
                'value' => 1
            ],
            [
                'text' => '普通',
                'value' => 2
            ],
        ];

        return response()->json($categories);
    }

    public function getSubCategoriesData(Request $request)
    {
        $subCategories = [
            [
                'text' => trans('product/sub_category.treadmill'),
                'value' => 1
            ],
            [
                'text' => trans('product/sub_category.elliptical'),
                'value' => 2
            ],
            [
                'text' => trans('product/sub_category.rowing_machine'),
                'value' => 3
            ],
            [
                'text' => trans('product/sub_category.bike'),
                'value' => 4
            ],
            [
                'text' => trans('product/sub_category.indoor_cycling'),
                'value' => 5
            ],
            [
                'text' => trans('product/sub_category.functional_machine'),
                'value' => 6
            ],
        ];

        return response()->json($subCategories);
    }

    public function getProductsData($categoryId, $subCategoryId)
    {
        $products = Product::where(['category_id' => $categoryId, 'sub_category_id' => $subCategoryId])->get();

        return response()->json($products);
    }

    public function getEventsData(Request $request)
    {
        $events = Event::all();

        return Datatables::of($events)
            ->addColumn('action', function ($item) {
                return '<a href="'.route('admin.event.detail', $item->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('status', function($item) {
                $status = $this->statusPresenter->getStatus($item, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function($item) {
                $time = Carbon::now();

                if ($item->created_at instanceof Carbon) {
                    $time =  $item->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
