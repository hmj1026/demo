@extends('layouts.base')

@section('title', $data['title'])

@section('breadcrumbs')
    <!-- 麵包屑導覽 -->
    <div class="container">
        <ul class="queleaBreadcrumbs list-inline">
            <li class="queleaBreadcrumb ">
                <a href="{{ url('/') }}" class="queleaBreadcrumb-label">首頁</a>
            </li>
            <li class="queleaBreadcrumb">
                <span class="queleaBreadcrumb-label">{{ $data['title'] }}</span>
            </li>
        </ul>
    </div>
    <div class="allProductTitle">
    <h3>{{ $data['title'] }}</h3>
    </div>
@endsection

@section('content')
    <section class="allProductList">
        @forelse ($data['products'] as $item)
            <div class="queleaProductBox">
                <div>
                    <a href="{{ route('product.detail', $item['id']) }}">
                        <img class="img-responsive" src="{{ asset($item['attachs']) }}" alt="">
                    </a>
                </div>
                <div>
                    <h3>
                        <a href="{{ route('product.detail', $item['id']) }}">{{ $item['name'] }}</a>
                    </h3>
                    <p>{{ $item['desc'] }}</p>
                    <p>網路價$ <span>{{ $item['price_web'] }}</span>元</p>
                    <p class="throughWord">定價$ {{ $item['price_com'] }}</p>
                    <div>
                        <a class="yellowButton" href="{{ route('product.detail', $item['id']) }}">
                            <p>了解更多</p>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            沒有產品
        @endforelse
        
    </section>
@endsection