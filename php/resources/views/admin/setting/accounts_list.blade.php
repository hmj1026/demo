@extends('adminlte::page')

@section('title', 'Accounts')

@section('content_header')
    <h1>帳號列表</h1>
@stop

@section('floated_plugin')
    <a 
        href="{{ route('admin.setting.account.create') }}" 
        class="btn" 
        style="background-color:rgba(0,0,0,.1);text_decoration:none;"
    >
        <i class="fas fa-plus"></i> 新增
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="accounts-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>種類</th>
                <th>帳號</th>
                <th>備註</th>
                <th>狀態</th>
                <th>更動時間</th>
                <th>新增時間</th>
                <th>編輯</th>
            </tr>
        </thead>
    </table>
@stop

@push('js')
<script>
    $(function() {
        $('#accounts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.setting.accounts.data') }}",
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
                { data: 'role_id', name: 'role_id' },
                { data: 'account', name: 'account' },
                { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        })
    })
</script>
@endpush