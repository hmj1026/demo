@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>訂單列表</h1>
@stop

@section('content')
    <table class="table table-bordered" id="orders-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>帳號</th>
                <th>收件者</th>
                <th>註冊姓名</th>
                <th>帳單地址</th>
                {{-- <th>使用折扣碼</th> --}}
                <th>是否付費</th>
                <th>是否出貨</th>
                <th>訂單金額</th>
                {{-- <th>備註</th> --}}
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
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.orders.data') }}",
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
                { data: 'account', name: 'account' },
                { data: 'recipient', name: 'recipient' },
                { data: 'is_user_detail_used', name: 'is_user_detail_used' },
                { data: 'is_billing_address_used', name: 'is_applied' },
                // { data: 'is_applied', name: 'is_applied' },
                { data: 'is_charged', name: 'is_charged' },
                { data: 'is_shipped', name: 'is_shipped' },
                { data: 'retail_amount', name: 'retail_amount' },
                // { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        }).order([0, 'desc'])
    })
</script>
@endpush