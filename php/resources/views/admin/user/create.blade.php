@extends('adminlte::page')

@section('title', 'User Create')

@section('content_header')
    <h1>會員新增</h1>
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
                    <div class="panel-heading">會員新增</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.user.store') }}" class="form-horizontal" method="post">
                            @csrf

                            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email"" class="col-sm-3 control-label">會員帳號</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">會員密碼</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="password"  value="{{ old('password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">再輸入密碼</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  value="{{ old('password_confirmation') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="comment" class="col-sm-3 control-label">備註</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="comment" id="comment" value="{{ old('comment') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-3 control-label">有效狀態</label>
                                <div class="col-sm-8">
                                    @inject('status', 'App\Presenters\StatusPresenter')
                                    {!! $status->getStatus(null, 'radio', $options['can_edit'] ?? true) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-8">
                                    <a href="{{ route('admin.users.show') }}" class="btn btn-primary">返回</a>
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

@push('js')
    <script>
        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@endpush