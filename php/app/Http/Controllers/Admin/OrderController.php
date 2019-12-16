<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderShippingDetail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;;

use App\Presenters\StatusPresenter;

class OrderController extends Controller
{
    public function __construct(
        StatusPresenter $statusPresenter)
    {
        $this->statusPresenter = $statusPresenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $admin = auth()->guard('admin')->user();
        
        $data = Order::where('id', $order->id)->first();
        
        $isEditadle = $admin->can('update', $data);
        $options = ['content_header' => '訂單內容', 'can_edit' => $isEditadle];

        return view('admin.order.detail', compact('data', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $orderP = $request->only(['is_charged', 'is_shipped', 'is_user_detail_used', 'is_billing_address_used', 'comment', 'status']);
        $detail = $request->get('detail');

        $params = ['order' => $orderP, 'detail' => []];
        if (isset($orderP['is_user_detail_used']) && (bool)$orderP['is_user_detail_used'] === false) {
            $params['detail'] = array_merge($params['detail'], Arr::only($detail, ['first_name', 'last_name']));
        }
        
        if (isset($orderP['is_billing_address_used']) && (bool)$orderP['is_billing_address_used'] === false) {
            $params['detail'] = array_merge($params['detail'], Arr::only($detail, ['postcode', 'city', 'address']));
        }

        if (! empty($params['detail'])) {
            $rules = [
                'is_user_detail_used' => [
                    'first_name' => 'required',
                    'last_name' => 'required'
                ],
                'is_billing_address_used' => [
                    'postcode' => 'required',
                    'city' => 'required',
                    'address' => 'required'
                ]
            ];

            $rules = collect(array_keys($rules))->reduce(function($carry, $key) use ($orderP, $rules) {
                if ((bool)$orderP[$key] === false) {
                    $carry = array_merge($carry, $rules[$key]);
                }

                return $carry; 
            }, []);
            
            Validator::make($params['detail'], $rules)->validate();
        }

        DB::beginTransaction();

        try {
            Order::where('id', $order->id)->update($params['order']);

            if (! empty($order['detail'])) {
                OrderShippingDetail::where('id', $order->detail->id)->update($params['detail']);
            }
            
            DB::commit();
            return back()->with(['message' => '更新成功', 'class' => 'success']);
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => $e->getMessage(), 'class' => 'danger']);
        }        
    }

    public function getOrderProducts(Request $request)
    {
        $orderProducts = OrderProduct::with(['product', 'order'])->where('order_id', $request->order_id)->get();
		
		return Datatables::of($orderProducts)
            ->addColumn('is_applied', function($item) {
                $event = $item->order->event ?? null;
                $couponName = isset($event) ? $event->coupon : '';
                
                return (bool)$item->order->is_applied === true
                    ? '<label class="label label-success">已使用</label> <label class="label label-primary">'.$couponName.'</label>' 
                    : '<label class="label label-danger">未使用</label>';
            })
            ->editColumn('created_at', function ($orderProduct) {
                $time = Carbon::now();

                if ($orderProduct->created_at instanceof Carbon) {
                    $time =  $orderProduct->created_at->toDateString();
                }

                return $time;
            })
            ->rawColumns(['is_applied'])
            ->make(true);
    }

    public function getOrdersData(Request $request)
    {
        $orders = Order::with('user.detail')->get();

		return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                return '<a href="'.route('admin.order.detail', $order->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('account', function ($item) {
                $userId = $item->user->id ?? 0;
                $email = $item->user->email ?? 'UNKNOWN';

                return '<a href="'.route('admin.user.detail', $userId).'" class="btn btn-xs btn-warning">'.$email.'</a>';
            })
            ->addColumn('recipient', function ($item) {

                $lastName = (bool)$item->is_user_detail_used === true
                    ? $item->user->detail->last_name
                    : $item->detail->last_name;
                $firstName = (bool)$item->is_user_detail_used === true
                    ? $item->user->detail->first_name
                    : $item->detail->first_name;
                return $lastName . ' '. $firstName;
            })
            ->editColumn('status', function ($order) {
                $status = $this->statusPresenter->getStatus($order, 'label');
                
                return $status;
            })
            ->editColumn('created_at', function ($order) {
                $time = Carbon::now();

                if ($order->created_at instanceof Carbon) {
                    $time =  $order->created_at->toDateString();
                }

                return $time;
            })
            ->editColumn('is_applied', function($item) {
                return (bool)$item->is_applied === true
                    ? '<label class="label label-success">已使用</label>' 
                    : '<label class="label label-danger">未使用</label>';
            })
            ->editColumn('is_charged', function($item) {
                return (bool)$item->is_charged === true
                    ? '<label class="label label-success">已扣款</label>' 
                    : '<label class="label label-danger">未扣款</label>';
            })
            ->editColumn('is_shipped', function($item) {
                return (bool)$item->is_shipped === true
                    ? '<label class="label label-success">已寄送</label>' 
                    : '<label class="label label-danger">未寄送</label>';
            })
            ->editColumn('is_user_detail_used', function($item) {
                return (bool)$item->is_user_detail_used === true
                    ? '<label class="label label-success">使用</label>' 
                    : '<label class="label label-danger">另填</label>';
            })
            ->editColumn('is_billing_address_used', function($item) {
                return (bool)$item->is_billing_address_used === true
                    ? '<label class="label label-success">使用</label>' 
                    : '<label class="label label-danger">另填</label>';
            })
			->rawColumns(['action', 'status', 'account', 'is_applied', 'is_charged', 'is_shipped', 'is_user_detail_used', 'is_billing_address_used'])
            ->make(true);
    }
}
