@extends('adminlte::page')

@section('title', 'User Detail')

@section('content_header')
    <h1>會員內容</h1>
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
                <ul id="user_detail" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#data" aria-controls="data" role="tab" data-toggle="tab" data-id="data">
                            會員資料
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#orders" aria-controls="orders" role="tab" data-toggle="tab" data-id="orders">
                            歷史訂單
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#equips" aria-controls="equips" role="tab" data-toggle="tab" data-id="equips">
                            擁有裝置
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#hopes" aria-controls="hopes" role="tab" data-toggle="tab" data-id="hopes">
                            希望清單
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="data">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <form action="{{ route('admin.user.update', $data->id) }}" class="form-horizontal" method="post">
                                    @csrf
                                    @method('PATCH')
        
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label">帳號</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="email" id="email" disabled value="{{ $data->email }}">
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label">稱謂</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="detail[gender]" id="gender" value="{{ $data->detail->gender }}">
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="name" class="col-sm-3 control-label">全名</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="detail[last_name]" id="last_name" {{ $options['can_edit'] === true ? '' : 'disabled' }} placeholder= "姓氏" value="{{ $data->detail->last_name ?? '' }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="detail[first_name]" id="first_name" {{ $options['can_edit'] === true ? '' : 'disabled' }} placeholder="名稱" value="{{ $data->detail->first_name ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="billing_address" class="col-sm-3 control-label">帳單地址 一</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="detail[billing_city]" id="billing_city" readonly placeholder="帳單城市" value="{{ $data->detail->billing_city ?? '' }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#modal_billing_address">
                                                        變更帳單地址城市
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="billing_address" class="col-sm-3 control-label">帳單地址 二</label>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="detail[billing_postcode]" id="billing_postcode" readonly placeholder= "郵遞區號" value="{{ $data->detail->billing_postcode ?? '' }}">
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="detail[billing_address]" id="billing_address" {{ $options['can_edit'] === true ? '' : 'disabled' }} placeholder="地址" value="{{ $data->detail->billing_address ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="phone_number" class="col-sm-3 control-label">電話號碼</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="detail[phone_number]" id="phone_number" {{ $options['can_edit'] === true ? '' : 'disabled' }} placeholder="電話號碼"" value="{{ $data->detail->phone_number ?? '' }}">
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <label for="comment" class="col-sm-3 control-label">備註</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="comment" id="comment" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ $data->comment ?? '' }}">
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
                                            <a href="{{ route('admin.users.show') }}" class="btn btn-primary">返回</a>
                                            <button type="submit" class="btn btn-danger" {{ $options['can_edit'] === true ? '' : 'disabled' }}>修改</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-bordered" id="orders-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>金流編號</th>
                                            <th>付費狀況</th>
                                            <th>物流狀況</th>
                                            <th>訂單金額</th>
                                            <th>狀態</th>
                                            <th>更新時間</th>
                                            <th>新增時間</th>
                                            <th>動作</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="equips">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-bordered" id="equips-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            {{-- <th>產品ID</th> --}}
                                            <th>產品名稱</th>
                                            <th>序號</th>
                                            <th>保固到期</th>
                                            <th>狀態</th>
                                            <th>更新時間</th>
                                            <th>新增時間</th>
                                            <th>編輯</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hopes">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-bordered" id="hopes-table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>產品ID</th>
                                            <th>產品名稱</th>
                                            <th>新增時間</th>
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

    <div class="modal fade" id="modal_billing_address" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius:4px;">
                <div class="modal-header">
                    <h4 class="modal-title">變更會員帳單地址城市</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form_city_change">
                        <div class="form-group">
                            <label for="billing_city_city" class="control-label col-sm-3">城市:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="detail[billing_city][city]" id="billing_city_city" data-type="city">

                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="billing_city_dist" class="control-label col-sm-3">城市:</label>
                            <div class="col-sm-8">
                                <select class="form-control col-sm-8" name="detail[billing_city][dist]" id="billing_city_dist" data-type="dist">
                                    
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
        $('#modal_billing_address').on('show.bs.modal', e => {
            ~async function() {
                await getCityOptions()
                await getAreaOptions(1001)
            }()
        })

        document.querySelector('#billing_city_city').addEventListener('change', e => {
            const element = e.target
            const cityId = element.value || ''
            const cityName = element.options[element.selectedIndex].text || ''

            if (cityId != '') {
                getAreaOptions(cityId)
            }
        })

        document.querySelector('#submit_city_change').addEventListener('click', e => {
            e.preventDefault()
            
            const formParamElems = document.querySelectorAll('#form_city_change select[name^="detail[billing_city]"]')
            const filtered = [...formParamElems].map((item, index) => {
                const type = item.dataset.type || ''
                return { 'type': type, 'id': item.value, 'text': item.options[item.selectedIndex].text }
            })

            const result = filtered.reduce((carry, item) => {
                if (! carry.hasOwnProperty('billing_city')) {
                    carry['billing_city'] = ''
                }

                if (item.type === 'city') {
                    carry['billing_city'] = `${item.text}${carry['billing_city']}`
                }
                
                if (item.type === 'dist') {
                    carry['billing_city'] = `${carry['billing_city']}${item.text}`
                }
                
                if (item.type === 'dist' && ! carry.hasOwnProperty('billing_postcode')) {
                    carry['billing_postcode'] = item.id
                }
                return carry
            }, {})

            if (Object.keys(result).length > 0) {
                Object.keys(result).forEach(key => {
                    $(`#${key}`).val(result[key])
                })

                $('#modal_billing_address').modal('hide')
            }
        })

        document.querySelectorAll('#user_detail li').forEach(item => {
            item.addEventListener('click', e => {
                const targetId = e.target.dataset.id
                const userId = '{{ $data->id }}'
                const paramsData = {
                    'orders': {
                        'url': '{{ route("admin.user.orders") }}',
                        'columns': [
                            { data: 'id', name: 'id' },
                            { data: 'cashflow_id', name: 'cashflow_id' },
                            { data: 'is_charged', name: 'is_charged' },
                            { data: 'is_shipped', name: 'is_shipped' },
                            { data: 'retail_amount', name: 'retail_amount' },
                            { data: 'status', name: 'status' },
                            { data: 'updated_at', name: 'updated_at' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'action', name: 'action', orderable: false, searchable: false }
                        ]
                    },
                    'equips': {
                        'url': '{{ route("admin.user.equips") }}',
                        'columns': [
                            { data: 'id', name: 'id' },
                            // { data: 'product_id', name: 'product_id' },
                            { data: 'product_name', name: 'product_name' },
                            { data: 'serial_number', name: 'serial_number' },
                            { data: 'warranty_valid_to', name: 'warranty_valid_to' },
                            { data: 'status', name: 'status' },
                            { data: 'updated_at', name: 'updated_at' },
                            { data: 'created_at', name: 'created_at' },
                            { data: 'action', name: 'action', orderable: false, searchable: false }
                        ]
                    },
                    'hopes': {
                        'url': '{{ route("admin.user.hopes") }}',
                        'columns': [
                            { data: 'id', name: 'id' },
                            { data: 'product_id', name: 'product_id' },
                            { data: 'product_name', name: 'product_name' },
                            { data: 'created_at', name: 'created_at' },
                        ]
                    }
                }
                if (paramsData.hasOwnProperty(targetId)) {
                    const params = paramsData[targetId]
                    const { url, columns } = params
                    if (url !== '') {
                        getTableByType(targetId, { url, userId, columns })
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

                    $('#billing_city_city').html(options)                    
                })
        }

        const getAreaOptions = cityId => {
            const selectElem = $('#billing_city_dist')
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
            const { url, userId, columns } = params
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
                        'user_id': userId
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