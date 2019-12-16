@extends('adminlte::page')

@section('title', 'Password')

@section('content_header')
    <h1>變更密碼</h1>
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
                    <div class="panel-heading">變更帳號密碼</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.setting.password.update') }}" class="form-horizontal" method="post">
                            @csrf
                            @method('PATCH')
                            {{-- <div class="form-group">
                                <label for="account" class="col-sm-3 control-label">管理者帳號</label>
                                <div class="col-sm-8">
                                    <input type="text" name="account" id="account" disabled value="{{ $admin->account }}">
                                </div>
                            </div> --}}

                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">請輸入新密碼</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password_confirmation" class="col-sm-3 control-label">再輸入新密碼</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-7">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                                        {{ trans('adminlte::adminlte.change_password') }}
                                    </button>
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
    <script>
        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@stop