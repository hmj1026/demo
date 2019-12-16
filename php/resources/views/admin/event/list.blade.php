@extends('adminlte::page')

@section('title', 'Event')

@section('content_header')
    <h1>活動列表</h1>
@stop

@section('floated_plugin')
    <a 
        href="{{ route('admin.event.create') }}" 
        class="btn" 
        style="background-color:rgba(0,0,0,.1);text_decoration:none;"
    >
        <i class="fas fa-plus"></i> 新增
    </a>
@endsection

@section('content')
    <table class="table table-bordered" id="events-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>配合網紅</th>
                <th>Coupon</th>
                {{-- <th>活動內容</th> --}}
                <th>啟用時間</th>
                <th>結束時間</th>
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
        $('#events-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.events.data') }}",
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
                { data: 'influncer_id', name: 'influncer_id' },
                { data: 'coupon', name: 'coupon' },
                // { data: 'content', name: 'content' },
                { data: 'started_at', name: 'started_at' },
                { data: 'expired_at', name: 'expired_at' },
                { data: 'comment', name: 'comment', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        })
    })
</script>
@endpush