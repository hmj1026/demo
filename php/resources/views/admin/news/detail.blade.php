@extends('adminlte::page')

@section('title', 'News Detail')

@section('content_header')
    <h1>新聞內容</h1>
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
                    <div class="panel-heading">新聞編輯</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.news.update', $data->id) }}" class="form-horizontal" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">分類</label>
                                <div class="col-sm-8">
                                    @inject('type', 'App\Presenters\News\TypePresenter')
                                    {!! $type->getNewsType($data, 'radio', $options['can_edit'] ?? false) !!}
                                </div>
                            </div>

                            <div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title"" class="col-sm-3 control-label">標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="title" id="title" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ $data->title }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sub_title" class="col-sm-3 control-label">副標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="sub_title" id="sub_title" {{ $options['can_edit'] === true ? '' : 'disabled' }} value="{{ $data->sub_title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-sm-3 control-label">內容</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="content" id="content" {{ $options['can_edit'] === true ? '' : 'disabled' }}>{{ $data->content ?? '' }}</textarea>
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
                                    <a href="{{ route('admin.news.show') }}" class="btn btn-primary">返回</a>
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
    <script src="{{ asset('vendor/ckeditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        const editor = CKEDITOR.replace( 'content', {
            language: 'zh',
            uiColor: '#9AB8F3',
            filebrowserImageBrowseUrl: '{{ url('laravel-filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('laravel-filemanager/upload?type=Images') }}&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '{{ url('laravel-filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('laravel-filemanager/upload?type=Files') }}&_token={{ csrf_token() }}'
        })

        editor.on('fileUploadRequest', event => {
            if (! event.data.requestData.hasOwnProperty('responseType')) {
                event.data.requestData['responseType'] = 'json'
            }
        })

        setTimeout(() => {
            $('.alert').alert('close')
        }, 3000)
    </script>
@endpush