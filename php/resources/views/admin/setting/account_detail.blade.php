@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    @isset ($options['content_header'])
        {{ $options['content_header'] }}
    @else
        <h1>Account Profile</h1>
    @endisset
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

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">帳號概要</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.setting.account.update', $admin->id) }}" class="form-horizontal" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $admin->id }}">
                            <div class="form-group">
                                <label for="account" class="col-sm-3 control-label">管理帳號</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="account" id="account" readonly value="{{ $admin->account }}">
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="role_id" class="col-sm-3 control-label">帳號類型</label>
                                <div class="col-sm-8">   
                                    @inject('AdminRole', 'App\Presenters\AdminRolePresenter')
                                    {!! $AdminRole->getRole($admin, 'select', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-sm-3 control-label">備註</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="comment" id="comment" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ $admin->comment }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">有效狀態</label>
                                <div class="col-sm-8">
                                    @inject('status', 'App\Presenters\StatusPresenter')
                                    {!! $status->getStatus($admin, 'radio', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="updated_at" class="col-sm-3 control-label">更新時間</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="updated_at" id="updated_at" readonly value="{{ $admin->updated_at }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created_at" class="col-sm-3 control-label">創建時間</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="created_at" id="created_at" readonly value="{{ $admin->created_at }}">
                                </div>
                            </div>

                            @if (Route::is('admin.setting.account.edit'))
                                <div class="form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8">
                                        <a href="{{ route('admin.setting.accounts.show') }}" class="btn btn-primary">返回</a>
                                        <button type="submit" class="btn btn-danger">修改</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@stop