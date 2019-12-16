<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;

use DB;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Presenters\News\TypePresenter;
use App\Presenters\StatusPresenter;

class NewsController extends Controller
{
    private $typePresenter;
    private $statusPresenter;

    public function __construct(
        TypePresenter $typePresenter,
        StatusPresenter $statusPresenter)
    {
        $this->typePresenter = $typePresenter;
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = ['content_header' => '創建新聞文章', 'can_edit' => true];

        return view('admin.news.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->except('_token'), [
            'type' => 'required',
            'title' => 'required',
            'content' => 'required'
        ])->validate();

        try {
            News::insert([
                'type' => $request->type,
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'content' => $request->content,
                'status' => $request->status,
            ]);

            return back()->with(['message' => '新增文章成功', 'class' => 'success']);
        } catch (\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $admin = auth()->guard('admin')->user();
        $data = News::where('id', $news->id)->first();

        $isEditadle = $admin->can('update', $data);
        $options = ['content_header' => '新聞內容', 'can_edit' => $isEditadle];

        return view('admin.news.detail', compact('data', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $params = $request->only(['type','title', 'sub_title', 'content', 'comment', 'status']);
        
        Validator::make($params, [
            'title' => 'required',
        ])->validate();

        try {
            News::where('id', $news->id)->update($params);

            return back()->with(['message' => '更新成功', 'class' => 'success']);
        } catch (\Exception $e) {

            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }
        
        return back()->with(['message' => '更新失敗', 'class' => 'danger']);
    }

    public function getNewsData(Request $request)
    {
        $news = News::all();

        return Datatables::of($news)
            ->addColumn('action', function ($item) {
                return '<a href="'.route('admin.news.detail', $item->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('sub_title', function($item) {
                $subTitleOri = !empty($item->sub_title) ? $item->sub_title : '';
                $subTitleCut = strlen($item->sub_title) > 20 ? mb_substr($item->sub_title, 0, 8, 'utf-8').'....<i class="icon-info-sign"></i>' : $item->sub_title;

                return '<div data-toggle="tooltip" data-placement="top" title="'.$subTitleOri.'">'.$subTitleCut.'</div>';
            })
            ->editColumn('content', function($item) {
                $contentOri = !empty($item->content) ? $item->content : '';
                $contentCut = strlen($item->content) > 20 ? mb_substr($item->content, 0, 16, 'utf-8').'....<i class="icon-info-sign"></i>' : $item->content;

                return '<div data-toggle="tooltip" data-placement="top" title="'.$contentOri.'">'.$contentCut.'</div>';
            })
            ->editColumn('type', function($item) {
                $type = $this->typePresenter->getNewsType($item, 'label');
                
                return $type;
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
            ->rawColumns(['action', 'status' ,'sub_title', 'content'])
            ->make(true);
    }
}
