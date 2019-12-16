@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
    @isset ($options['content_header'])
        {{ $options['content_header'] }}
    @else
        <h1>Role Detail</h1>
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
            <div class="col-md-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">帳號類型概要</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.setting.role.update', $role->id) }}" class="form-horizontal" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            <div class="form-group">
                                <label for="account" class="col-sm-2 control-label">帳號類型</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="title" readonly value="{{ $role->title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="permission" class="col-sm-2 control-label">類型權限</label>
                                <div class="col-sm-8">
                                    @inject('permission', 'App\Presenters\AdminPermissionPresenter')
                                    {!! $permission->getPermission($role->permissions, 'checkbox', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">有效狀態</label>
                                <div class="col-sm-8">
                                    @inject('status', 'App\Presenters\StatusPresenter')
                                    {!! $status->getStatus($role, 'radio', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="updated_at" class="col-sm-2 control-label">更新時間</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="updated_at" id="updated_at" readonly value="{{ $role->updated_at }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="created_at" class="col-sm-2 control-label">創建時間</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="created_at" id="created_at" readonly value="{{ $role->created_at }}">
                                </div>
                            </div>

                            @if (Route::is('admin.setting.role.edit'))
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                        <a href="{{ route('admin.setting.roles.show') }}" class="btn btn-primary">返回</a>
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