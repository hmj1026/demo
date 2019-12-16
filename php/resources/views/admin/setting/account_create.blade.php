@extends('adminlte::page')

@section('title', 'Create')

@section('content_header')
    @isset ($options['content_header'])
        {{ $options['content_header'] }}
    @else
        <h1>Account Create</h1>
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
                        <form action="{{ route('admin.setting.account.store') }}" class="form-horizontal" method="post">
                            @csrf
                            <div class="form-group has-feedback {{ $errors->has('account') ? 'has-error' : '' }}">
                                <label for="account" class="col-sm-3 control-label">帳號名稱</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="account" id="account" value="">
                                    <span class="form-control-feedback"></span>
                                    @if ($errors->has('account'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('account') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback {{ $errors->has('account') ? 'has-error' : '' }}">
                                <label for="password"" class="col-sm-3 control-label">帳號密碼</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="password" id="password" value="">
                                    <span class="form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label for="role_id" class="col-sm-3 control-label">帳號類型</label>
                                <div class="col-sm-8">   
                                    @inject('AdminRole', 'App\Presenters\AdminRolePresenter')
                                    {!! $AdminRole->getRole(null, 'select', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">有效狀態</label>
                                <div class="col-sm-8">
                                    @inject('status', 'App\Presenters\StatusPresenter')
                                    {!! $status->getStatus(null, 'radio', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment""" class="col-sm-3 control-label">備註</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="comment" id="comment" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-10">
                                    <a href="{{ route('admin.setting.accounts.show') }}" class="btn btn-primary">返回</a>
                                    <button type="submit" class="btn btn-danger">新增</button>
                                </div>
                            </div>
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

@stop