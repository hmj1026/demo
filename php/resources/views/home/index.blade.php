@extends('layouts.base')

@section('title', '首頁')

@section('content')
    <!--每頁形象圖-->
    <section>
        @forelse ($data['promo'] as $item)
            <img class="{{ $item['class'] }} img-responsive" src="{{ $item['attachs'] }}" alt="">
        @empty
            
        @endforelse
    </section>

    <!--首頁 大圖 推薦商品-->
    <section>
        @forelse ($data['main'] as $item)
             @if ($loop->odd)
                 @php
                     $class_background = 'indBestPro-bike';
                     $class_content = 'indBestContentRight';
                     $class_direction = '';
                 @endphp
             @endif
             @if ($loop->even)
                 @php
                     $class_background = 'indBestPro-trea';
                     $class_content = 'indBestContentLeft';
                     $class_direction = 'pull-right';
                 @endphp
             @endif
 
             <div class="{{$class_background}}">
                 <div class="container">
                     <div class="col-sm-6 col-xs-12 {{ $class_direction }}"><img class="img-responsive" src="{{ $item['attachs'] }}" alt=""></div>
                     <div class="{{ $class_content }} col-sm-6 col-xs-12">
                         <h3>{{ $item['name'] }}</h3>
                         <p>{{ $item['desc'] }}</p>
                         <div>
                             <div class="halfTheDiv">
                                 <p>網路價$ <span class="big-sale">{{ $item['price_web'] }}</span>元</p>
                                 <p class="throughWord">定價$ {{ $item['price_com'] }}</p>
                             </div>
                             <div class="halfTheDiv"><a class="yellowButton" href=""><p>了解更多</p></a></div>
                         </div>
                     </div>
                 </div>	
             </div>
        @empty
            
        @endforelse
     </section>

    <!--配件-->
    <section>
        <div class="container accessoriesRecommend">
            <div class="accRecoImage"></div>
            <div class="accRecoContent">
                <h3>配件</h3>
                <div class="accRecoBigBox">
                    @forelse ($data['sub'] as $item)

                        @php
                            $isNeeded = !empty($item['type']) ? '-' : '';
                        @endphp

                        <div class="accRecoBox">
                            <div>
                            <a href="##"><img class="img-responsive" src="{{ $item['attachs'] }}" alt=""></a>
                            </div>
                            <div><a href="##"><p>{{ $item['type'] }}{{ $isNeeded }}{{ $item['name'] }}</p></a>
                            <p class="throughWord">定價$ {{ $item['price_com'] }}</p>
                            <p>網路價$ <span class="recommendSale">{{ $item['price_web'] }}</span>元</p></div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>			
            </div>
        </div>
    </section>

    <!--產品推薦banner-->
    <section class="container recoProductBanner">
        @forelse ($data['banner'] as $item)
            <div class="col-sm-6 col-xs-12">
            <a href="##"><img class="img-responsive" src="{{ $item['attachs'] }}" alt=""></a>
            </div>
        @empty
            
        @endforelse
    </section>
@endsection
