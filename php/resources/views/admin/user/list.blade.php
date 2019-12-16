@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>會員列表</h1>
@stop

@section('floated_plugin')
    <a 
        href="{{ route('admin.user.create') }}" 
        class="btn" 
        style="background-color:rgba(0,0,0,.1);text_decoration:none;"
    >
        <i class="fas fa-plus"></i> 新增
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>會員帳號</th>
                <th>會員姓名</th>
                <th>性別稱謂</th>
                <th>帳單郵遞區號</th>
                <th>帳單城市</th>
                <th>帳單地址</th>
                <th>連絡電話</th>
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.users.data') }}",
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
                { data: 'email', name: 'email' },
                { data: 'fullname', name: 'fullname' },
                { data: 'detail.gender', name: 'detail.gender' },
                { data: 'detail.billing_postcode', name: 'detail.billing_postcode' },
                { data: 'detail.billing_city', name: 'detail.billing_city' },
                { data: 'detail.billing_address', name: 'detail.billing_address' },
                { data: 'detail.phone_number', name: 'detail.phone_number' },
                { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]},
        ).order([0, 'desc'])
    })
</script>
@endpush