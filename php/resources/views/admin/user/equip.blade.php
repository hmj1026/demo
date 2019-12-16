@extends('adminlte::page')

@section('title', 'User Equip Detail')

@section('content_header')
    <h1>會員裝置細節</h1>
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
                <div class="panel panel-primary">
                    <div class="panel-heading">裝備概要</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.user.equip.update', $data->id) }}" class="form-horizontal" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">品名</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" id="name" disabled value="{{ $data->product->name ?? 'UNKNOWN' }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc" class="col-sm-3 control-label">序號</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="serial_number" id="serial_number" disabled value="{{ $data->serial_number }}">
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
                                    <a href="{{ route('admin.user.detail', $data->user_id) }}" class="btn btn-primary">返回</a>
                                    <button type="submit" class="btn btn-danger" {{ $options['can_edit'] === true ? '' : 'disabled' }}>修改</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@endpush