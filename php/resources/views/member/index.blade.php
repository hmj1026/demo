@extends('layouts.base')

@section('title', '會員專區')

@section('breadcrumbs')
    <!-- 麵包屑導覽 -->
    <div class="container">
        <ul class="queleaBreadcrumbs list-inline">
            <li class="queleaBreadcrumb ">
                <a href="{{ url('/') }}" class="queleaBreadcrumb-label">首頁</a>
            </li>
            <li class="queleaBreadcrumb">
                <span class="queleaBreadcrumb-label">會員專區</span>
            </li>
        </ul>
    </div>
    <div class="allProductTitle">
        <h3>會員專區</h3>
    </div>
@endsection

@section('content')

@endsection