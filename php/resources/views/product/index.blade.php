@extends('layouts.base')

@section('title', '健身器材')

@section('breadcrumbs')
    <!-- 麵包屑導覽 -->
    <div class="container">
        <ul class="queleaBreadcrumbs list-inline">
            <li class="queleaBreadcrumb ">
                <a href="{{ url('/') }}" class="queleaBreadcrumb-label">首頁</a>
            </li>
            <li class="queleaBreadcrumb">
                <a href="">
                    <span class="queleaBreadcrumb-label">健身器材</span>
                </a>
            </li>
            <li class="queleaBreadcrumb">
                <span class="queleaBreadcrumb-label">
                    {{ $data['name'] }}
                </span>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- 產品詳情頁面 上方-->
    <section class="queleaProIntroduceOuter">
        <div class="queleaProIntroduceInner container">
            <!--產品內頁 大圖輪播--> 
            <div class="queleaProductTop">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="slider-container pdtboximg-big">
                        <div class="slider has-touch">
                            @forelse ($data['attachs'] as $item)
                                @if ($item['attach_flag'] === 'carousel')
                                    <div class="pdtboximg-big-box slider__item">
                                        <img class="img-responsive" src="{{ asset($item['attach_src'].$item['attach_name']) }}" draggable="false">
                                    </div>
                                @endif
                            @empty
                                
                            @endforelse
                        </div>

                        <div class="slider__switch slider__switch--prev" data-ikslider-dir="prev" disabled="disabled">
                            <span><i class="fas fa-chevron-circle-left"></i></span> 
                        </div>
                        <div class="slider__switch slider__switch--next" data-ikslider-dir="next">
                            <span><i class="fas fa-chevron-circle-right"></i></span> 
                        </div>	
                    </div>
                    <!--產品內頁 小圖方塊--> 
                    <div class="pdtboximg-small preview">
                        @php
                            $i = 1;
                        @endphp

                        @forelse ($data['attachs'] as $item)
                            @if ($item['attach_flag'] === 'carousel')
                                
                                {{-- <div class="pdtboximg-big-box slider__item">
                                    <img class="img-responsive" src="{{ asset($item['attach_src'].$item['attach_name']) }}" draggable="false">
                                </div> --}}

                                <a href="{{ '#'.$i }}" class="">
                                    <img src="{{ asset($item['attach_src'].$item['attach_name']) }}" alt="">
                                </a>
                                
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @empty
                            
                        @endforelse
                    </div>
                </div>

                <!--產品內頁 品名價格 -->
                <div class="pdtNamePrice col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>{{ $data['name'] }}</h3>
                    <p>{{ $data['desc'] }}</p>
                    <hr>
                    <div>
                        <p>網路價$ <span class="big-sale">{{ $data['price_web'] }}</span>元</p>
                        <p class="throughWord">定價$ {{ $data['price_com'] }}</p>
                    </div>
                    <hr>
                    <div class="pdt-button">
                        <a href="##" class="buyNow">
                            <p>直接購買</p> 
                        </a>
                        <a  href="##" class="addToShopCart">
                            <p>加入購物車<i class="fas fa-shopping-cart"></i></p> 
                        </a>
                    </div>
                </div>
            </div>

            <!--影片-->
            <div class="pdtVideoBox">
                <div class="pdtContainer">
                    @forelse ($data['attachs'] as $item)
                        @if ($item['attach_type'] === 'video')
                            <div class="pdtVideo">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $item['attach_src'] }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- 產品詳情頁面 下方-->
    <section>
        <div class="container">
            <!--快速選擇區塊-->
            <ul class="pdtBar">
                <li class="active">
                    <a data-toggle="tab" href="#productContent">商品介紹</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#ProductSpecification">商品規格</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#reminder">注意事項</a>
                </li>
            </ul>

            <!--產品詳情-->
            <div class="tab-content pdtBox">
                <!--頁籤1 產品介紹-->
                <div id="productContent" class="pdtDes tab-pane fade in active">
                    @forelse ($data['attachs'] as $item)
                        @if ($item['attach_flag'] === 'desc')
                            <img src="{{ asset($item['attach_src'].$item['attach_name']) }}" alt="">
                        @endif
                    @empty
                        尚無資料
                    @endforelse
                </div>
                <!--頁籤2 產品規格-->
                <div id="ProductSpecification" class="pdtSpec tab-pane fade">
                    <table class="table table--bordered table--product-detail">
                        <tbody>
                            <tr><th class="col-3"><p>產品尺寸</p></th>
                            <td><p>125.5x60.5x123cm<br>125.5x60.5x123cm</p></td></tr>
                            <tr><th class="col-3"><p>飛輪重量</p></th>
                            <td><p>18kg</p></td></tr>
                            <tr><th class="col-3"><p>機台重量</p></th>
                            <td><p>46kg</p></td></tr>
                            <tr><th class="col-3"><p>阻力段數</p></th>
                            <td><p>無段式</p></td></tr>
                            <tr><th class="col-3"><p>螢幕顯示</p></th>
                            <td><p>3.5" LCD螢幕</p></td></tr>
                            <tr><th class="col-3"><p>顯示資訊</p></th>
                            <td><p>心率 / 迴轉速(RPM) / 時間 / 距離 / 卡路里</p></td></tr>
                        </tbody>
                    </table>
                </div>
                <!--頁籤3 注意事項-->
                <div id="reminder" class="pdtReminder tab-pane fade">
                <p>
                    網路抓別人的<br>
                    ※採貨運配送(箱裝出貨)，其中20%需自行DIY組裝，內有工具、組裝說明書及影片。<br>
                    ※貨運僅配送至一樓，無搬運上樓服務。<br>
                    ※西部非偏遠地區，可加購專人到府組裝(1000元)，樓層另計。<br>
                    ※偏遠、東部、外島等地區需酌收額外運費。<br>
                    ※配送時間為週一到週六白天(週日或晚上無配送服務)。<br>
                    ※此為「家庭用」飛輪車，若團體機關、社區健身房使用將影響保固。</p>
                </div>
            </div>
        </div>

    </section>

    <!--推薦商品-->
    <section class="queleaOtherPdt">
        <h3>你也許也喜歡</h3>
        <div class="otherPdtBox">	
            <div class="otherPdt">
                <img class="img-responsive" src="{{asset('images/1808101059232.jpg')}}" alt="">
                <div class="otherPdtNameBox">	
                    <p>BH 飛輪車專用-新款電子錶手機平板托架組</p>
                    <a href="##"><p>了解更多</p></a>
                </div>
            </div>
            <div class="otherPdt">
                <img class="img-responsive" src="{{asset('images/1808101059232.jpg')}}" alt="">
                <div class="otherPdtNameBox">	
                <p>BH 飛輪車專用-新款電子錶手機平板托架組</p>
                <a href="##"><p>了解更多</p></a>
                </div>
            </div>
            <div class="otherPdt">
                <img class="img-responsive" src="{{asset('images/1808101059232.jpg')}}" alt="">
                <div class="otherPdtNameBox">	
                    <p>BH 飛輪車專用-新款電子錶手機平板托架組輪車專用-新款電子</p>
                    <a href="##"><p>了解更多</p></a>
                </div>
            </div>
            <div class="otherPdt">
                <img class="img-responsive" src="{{asset('images/1808101059232.jpg')}}" alt="">
                <div class="otherPdtNameBox">	
                    <p>BH 飛輪車專用-新款電子錶手機平板托架組</p>
                    <a href="##"><p>了解更多</p></a>
                </div>
            </div>
        </div>	
            
    </section>
@endsection

@push('scripts')
    <script>
        $(".slider-container").ikSlider({
            speed: 500
        })

        $(function() {
            const previewElems = $('.preview a')
            const previewElemsCnt = previewElems.length || 0

            changeActivePreview(0)

            $('.slider-container').on('changeSlide.ikSlider', function(e) {
                changeActivePreview(e.currentSlide);
            })

            previewElems.on('mousedown', e => {
                e.preventDefault();
                var index = $(this).index();
                $('.slider-container').ikSlider(index);
            })

            const changeActivePreview = i => {
                const prevIndex = i === 0 ? previewElemsCnt - 1 : parseInt(i) - 1

                previewElems.eq(prevIndex).removeClass('active')
                previewElems.eq(i).addClass('active')
            }
        })
    </script>
@endpush