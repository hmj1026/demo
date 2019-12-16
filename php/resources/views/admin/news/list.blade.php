@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>新聞公告</h1>
@stop

@section('floated_plugin')
    <a 
        href="{{ route('admin.news.create') }}" 
        class="btn" 
        style="background-color:rgba(0,0,0,.1);text_decoration:none;"
    >
        <i class="fas fa-plus"></i> 新增
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="news-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>新聞分類</th>
                <th>新聞標題</th>
                <th>新聞副標</th>
                <th>新聞內文</th>
                <th>備註</th>
                <th>狀態</th>
                <th>新增時間</th>
                <th>編輯</th>
            </tr>
        </thead>
    </table>
@stop

@push('js')
<script>
    $(function() {
        $('#news-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.news.data') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            language: {
                url: "{{ asset('vendor/datatables/'.app()->getLocale().'.json') }}"
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'title', name: 'title' },
                { data: 'sub_title', name: 'sub_title' },
                { data: 'content', name: 'content' },
                { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        })
    })
</script>
@endpush