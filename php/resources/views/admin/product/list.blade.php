@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1>產品列表</h1>
@stop

@section('content')
    <table class="table table-bordered" id="products-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>器材分類</th>
                <th>器材種類</th>
                <th>品名</th>
                <th>描述</th>
                <th>定價</th>
                <th>網路價</th>
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
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.products.data') }}",
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
                { data: 'category_id', name: 'category_id' },
                { data: 'sub_category_id', name: 'sub_category_id' },
                { data: 'name', name: 'name' },
                { data: 'desc', name: 'desc' },
                { data: 'price_com', name: 'price_com' },
                { data: 'price_web', name: 'price_web' },
                { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        })
    })
</script>
@endpush