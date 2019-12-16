@extends('adminlte::page')

@section('title', 'Order Detail')

@section('content_header')
    <h1>訂單內容</h1>
@stop

@section('content')
    @if (session('message'))
        <div class="alert alert-{{ session('class') }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <!-- Nav tabs -->
                <ul id="order_detail" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#data" aria-controls="data" role="tab" data-toggle="tab" data-id="data">
                            訂單資料
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#products" aria-controls="orders" role="tab" data-toggle="tab" data-id="products">
                            訂單內容
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="data">
                        <div class="panel panel-primary">
                            <div class="panel-heading">訂單編輯</div>
                            <div class="panel-body">
                                <form action="{{ route('admin.order.update', $data->id) }}" class="form-horizontal" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group has-feedback">
                                        <label for="email" class="col-sm-3 control-label">帳號資訊</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="email" id="email" disabled value="{{ $data->user->email }}">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                    {{ old('is_user_detail_used')}}
                                                </div>
                                                <div class="col-sm-6">
                                                    @inject('userName', 'App\Presenters\User\FullnamePresenter')
                                                    <input type="text" class="form-control" name="user_detail_fullName" id="user_detail_fullName" disabled value="{{ $userName->getFullname($data->user) }}">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="email" class="col-sm-3 control-label">帳單地址</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    @inject('userAddress', 'App\Presenters\User\FullAddressPresenter')
                                                    <input type="text" class="form-control" name="user_detail_fullAddress" id="user_detail_fullAddress" disabled value="{{ $userAddress->getFullAddress($data->user) }}">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="{{ route('admin.user.detail', $data->user_id) }}" class="btn btn-warning btn-md">
                                                        變更帳單地址
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="is_applied" class="col-sm-3 control-label">折扣碼資訊</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @inject('isApplied', 'App\Presenters\Order\CouponAppliedPresenter')
                                                    {!! $isApplied->getCouponApplied($data, 'radio', false) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="event_id" id="event_id" disabled value="{{ $data->event_id ?? '' }}">
                                                    <input type="text" class="form-control" name="coupon" id="coupon" disabled value="{{ isset($data->event) ? $data->event->coupon : '' }}">
                                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="is_charged" class="col-sm-3 control-label">訂單進度</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @inject('charged', 'App\Presenters\Order\ChargedPresenter')
                                                    {!! $charged->getChargedStatus($data, 'radio', $options['can_edit'] ?? false) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    @inject('shipped', 'App\Presenters\Order\ShippedPresenter')
                                                    {!! $shipped->getShippedStatus($data, 'radio', $options['can_edit'] ?? false) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="is_default_user_detail" class="col-sm-3 control-label">訂單收件者資訊</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @inject('userDetail', 'App\Presenters\Order\UserDetailPresenter')
                                                    {!! $userDetail->getUserDetail($data, 'radio', $options['can_edit'] ?? false) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row using_user_detail" style="display:{{ (bool)$data->is_user_detail_used === true ? 'none' : 'block' }};">
                                                        <div class="col-sm-6 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                                            <input type="text"
                                                                class="form-control" 
                                                                name="detail[last_name]" 
                                                                id="last_name" 
                                                                {{ $options['can_edit'] === true ? '' : 'disabled' }} 
                                                                placeholder="姓氏" 
                                                                value="{{ (bool)$data->is_user_detail_used === false ? $data->detail->last_name : '' }}"
                                                            >
                                                            @if ($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-6 {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                                            <input type="text"
                                                                class="form-control"
                                                                name="detail[first_name]" 
                                                                id="first_name" 
                                                                {{ $options['can_edit'] === true ? '' : 'disabled' }} 
                                                                placeholder="名字" 
                                                                value="{{ (bool)$data->is_user_detail_used === false ? $data->detail->first_name : '' }}"
                                                            >
                                                            @if ($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label for="is_default_billing_address" class="col-sm-3 control-label">訂單收件地址</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @inject('orderDetail', 'App\Presenters\Order\OrderDetailPresenter')
                                                    {!! $orderDetail->getOrderDetail($data, 'radio', $options['can_edit'] ?? false) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row using_billing_address" style="display:{{ (bool)$data->is_billing_address_used === true ? 'none' : 'block' }};">
                                                        <div class="col-sm-6">
                                                            <input type="text"
                                                                class="form-control" 
                                                                name="detail[postcode]" 
                                                                id="order_postcode" 
                                                                {{ $options['can_edit'] === true ? '' : 'disabled' }}
                                                                readonly 
                                                                placeholder="郵遞區號" 
                                                                value="{{ (bool)$data->is_billing_address_used === false ? $data->detail->postcode : '' }}"
                                                            >
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modal_order_address">
                                                                變更寄送城市
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback using_billing_address" style="display:{{ (bool)$data->is_billing_address_used === true ? 'none' : 'block' }};">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text"
                                                        class="form-control" 
                                                        name="detail[city]" 
                                                        id="order_city" 
                                                        {{ $options['can_edit'] === true ? '' : 'disabled' }}
                                                        readonly 
                                                        placeholder="城市區域" 
                                                        value="{{ (bool)$data->is_billing_address_used === false ? $data->detail->city : '' }}"
                                                    >
                                                </div>
                                                <div class="col-sm-6 {{ $errors->has('address') ? 'has-error' : '' }}">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="detail[address]" 
                                                        id="order_address" 
                                                        {{ $options['can_edit'] === true ? '' : 'disabled' }} 
                                                        placeholder="收件地址" 
                                                        value="{{ (bool)$data->is_billing_address_used === false ? $data->detail->address : '' }}"
                                                    >
                                                    @if ($errors->has('address'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="comment" class="col-sm-3 control-label">備註</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="comment" id="comment" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ $data->comment }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status" class="col-sm-3 control-label">有效狀態</label>
                                        <div class="col-sm-8">
                                            @inject('status', 'App\Presenters\StatusPresenter')
                                            {!! $status->getStatus($data, 'radio', $options['can_edit'] ?? false) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="updated_at" class="col-sm-3 control-label">更新時間</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="updated_at" id="updated_at" readonly value="{{ $data->updated_at }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at" class="col-sm-3 control-label">創建時間</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="created_at" id="created_at" readonly value="{{ $data->created_at }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-8">
                                            <a href="{{ route('admin.orders.show') }}" class="btn btn-primary">返回</a>
                                            <button type="submit" class="btn btn-danger" {{ $options['can_edit'] === true ? '' : 'disabled' }}>修改</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="products">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-bordered" id="products-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>金流Id</th>
                                            {{-- <th>產品Id</th> --}}
                                            <th>產品名稱</th>
                                            <th>數量</th>
                                            <th>網路價</th>
                                            <th>使用折扣碼</th>
                                            {{-- <th>更新時間</th> --}}
                                            <th>新增時間</th>
                                            {{-- <th>編輯</th> --}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_order_address" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:4px;">
                <div class="modal-header">
                    <h4 class="modal-title">變更訂單地址城市</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form_city_change">
                        <div class="form-group">
                            <label for="order_city_city" class="control-label col-sm-3">城市:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="detail[order_city][city]" id="order_city_city" data-type="city">

                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="order_city_dist" class="control-label col-sm-3">城市:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="detail[order_city][dist]" id="order_city_dist" data-type="dist">
                                    
                                </select>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" disabled="disabled" id="submit_city_change">確認</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@push('js')
    <script>
        const old_is_user_detail_used = '{{ old("is_user_detail_used") }}'
        const old_is_billing_address_used = '{{ old("is_billing_address_used") }}'
        if (typeof old_is_user_detail_used !== 'undefined' && parseInt(old_is_user_detail_used) === 0) {
            document.querySelector('.using_user_detail').style.display = 'block'
        }
        if (typeof old_is_billing_address_used !== 'undefined' && parseInt(old_is_billing_address_used) === 0) {
            document.querySelectorAll('.using_billing_address').forEach(item => item.style.display = 'block')
        }
        
        $('#modal_order_address').on('show.bs.modal', e => {
            ~async function() {
                await getCityOptions()
                await getAreaOptions(1001)
            }()
        })

        document.querySelectorAll('input[name=is_user_detail_used]').forEach(item => {
            item.addEventListener('click', e => {
                const targetVal = e.target.value
                const entryElem = document.querySelector('.using_user_detail')

                if (parseInt(targetVal) === 1) {
                    entryElem.style.display = 'none'
                    return
                }

                entryElem.style.display = 'block'
            })
        })

        document.querySelectorAll('input[name=is_billing_address_used]').forEach(item => {
            item.addEventListener('click', e => {
                const targetVal = e.target.value
                const entryElems = document.querySelectorAll('.using_billing_address')

                if (parseInt(targetVal) === 1) {
                    entryElems.forEach(item => item.style.display = 'none')
                    return
                }

                entryElems.forEach(item => item.style.display = 'block')
            })
        })

        document.querySelector('#submit_city_change').addEventListener('click', e => {
            e.preventDefault()
            
            const formParamElems = document.querySelectorAll('#form_city_change select[name^="detail[order_city]"]')
            const filtered = [...formParamElems].map((item, index) => {
                const type = item.dataset.type || ''
                return { 'type': type, 'id': item.value, 'text': item.options[item.selectedIndex].text }
            })

            const result = filtered.reduce((carry, item) => {
                if (! carry.hasOwnProperty('order_city')) {
                    carry['order_city'] = ''
                }

                if (item.type === 'city') {
                    carry['order_city'] = `${item.text}${carry['order_city']}`
                }
                
                if (item.type === 'dist') {
                    carry['order_city'] = `${carry['order_city']}${item.text}`
                }
                
                if (item.type === 'dist' && ! carry.hasOwnProperty('order_postcode')) {
                    carry['order_postcode'] = item.id
                }
                return carry
            }, {})

            if (Object.keys(result).length > 0) {
                Object.keys(result).forEach(key => {
                    $(`#${key}`).val(result[key])
                })

                $('#modal_order_address').modal('hide')
            }
        })

        document.querySelectorAll('#order_detail li').forEach(item => {
            item.addEventListener('click', e => {
                const targetId = e.target.dataset.id
                const orderId = '{{ $data->id }}'
                const paramsData = {
                    'orders': {
                        'url': '',
                        'columns': [
                            
                        ]
                    },
                    'products': {
                        'url': '{{ route("admin.order.products") }}',
                        'columns': [
                            { data: 'id', name: 'id' },
                            { data: 'order_id', name: 'order_id' },
                            // { data: 'product_id', name: 'product_id' },
                            { data: 'product.name', name: 'product.name' },
                            { data: 'quantity', name: 'quantity' },
                            { data: 'product.price_web', name: 'product.price_web' },
                            { data: 'is_applied', name: 'is_applied', orderable: false, searchable: false },
                            // { data: 'updated_at', name: 'updated_at' },
                            { data: 'created_at', name: 'created_at' },
                            // { data: 'action', name: 'action', orderable: false, searchable: false }
                        ]
                    },
                }
                if (paramsData.hasOwnProperty(targetId)) {
                    const params = paramsData[targetId]
                    const { url, columns } = params
                    if (url !== '') {
                        getTableByType(targetId, { url, orderId, columns })
                        return 
                    }
                }
            })
        })

        const getCityOptions = () => {
            fetch('{{ route("admin.citys.data") }}')
                .then(response => {
                    return response.json()
                })
                .then(result => {
                    const options = Object.keys(result).reduce((carry, key) => {
                        const city = result[key] || ''
                        if (city != '') {
                            carry += `<option value="${key}">${city}</option>`
                        }
                        return carry
                    },'')

                    $('#order_city_city').html(options)                    
                })
        }

        const getAreaOptions = cityId => {
            const selectElem = $('#order_city_dist')
            const changeBtn = $('#submit_city_change')
            const url = `{{route('admin.areas.data')}}?id=${cityId}`
            
            selectElem.html('<option value="">請稍後...</option>')
            changeBtn.attr('disabled', true)

            fetch(url).then(response => {
                return response.json()
            }).then(result => {
                const areas = result[cityId] || ''
                const options = Object.keys(areas).reduce((carry, key) => {
                    const area = areas[key] || ''
                    if (area != '') {
                        carry += `<option value='${ key }'>${ area }</option>`
                    }
                    return carry
                },'')

                selectElem.html(options)
                changeBtn.attr('disabled',false)                
            })
        }

        const getTableByType = (id, params) => {
            const { url, orderId, columns } = params
            $(`#${id}-table`).DataTable({
                processing: true,
                serverSide: true,
                destroy: true, //Cannot reinitialise DataTable 解決重新載入表格內容問題
                ajax: {
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'order_id': orderId
                    }
                },
                language: {
                    url: "{{ asset('vendor/datatables/'.app()->getLocale().'.json') }}"
                },
                columns: columns
            })
        }

        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@endpush