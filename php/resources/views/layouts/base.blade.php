<!DOCTYPE html> 
<html  lang="zh-Hant-TW">
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="@csrf_token() ">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--全站CSS-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/quelea-onlineshop.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu-styles.css')}}">  
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title') | 線上購物</title>
</head>
<body>
    <div id="app">
        <section id='cssmenu'>
            <!--手機 上層 選單-->
            <div class="phoneTopMenu">
                <a href="##"><img src="{{ asset('images/index-top-logo.png') }}" alt=""></a>
                <div>
                    <a href="{{ route('cart.show') }}"><i class="fas fa-shopping-cart">(0)</i></a>

                    @auth
                        <a href="{{ route('member') }}"><i class="fas fa-user">會員專區</i></a></li>
                    @endauth

                    <a id="menu-button"><i class="fas fa-bars"></i></a>
                </div>
            </div>

            <!--all選單-->
            <div class="queleaMenu">
                <!--PC 上層 選單-->
                <div class="queleaTopMenu">
                    <div class="container">
                        <a href="{{ url('/') }}"><img class="img-responsive" src="{{ asset('images/index-top-logo.png') }}" alt=""></a>
                        <p>Welcome to DEMO onlineshop.</p>
                        <ul class="list-inline">
                            <li><a href="{{ route('cart.show') }}"><i class="fas fa-shopping-cart">(0)</i></a></li>
                            @guest
                                <li><a href="{{ route('login') }}">會員登入</a></li>
                            @else
                                <li><a href="{{ route('member') }}"><i class="fas fa-user">會員專區</i></a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
                            @endguest
                        </ul>
                    </div>	
                </div>
                <!--列表選單-->
                @include('partials.nav')
                
                <!--列表 手機底部 選單-->	
                <div class="queleaBottomMenu ">
                    <ul class="list-inline container">
                        @guest
                            <li><a href="{{ route('login') }}">會員登入</a></li>
                        @else
                            <li><a href="{{ route('member') }}"><i class="fas fa-user">會員專區</i></a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">登出</a></li>
                        @endguest
                    </ul>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </section>

        @yield('breadcrumbs')

        @yield('content')

        @include('partials.footer')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function() {
            $("#toTop").mousedown(function(){
                $("html,body").animate({
                    scrollTop:0
                },800)
            })

            $(window).scroll(function() {
                if ( $(this).scrollTop() > 300){
                    $('#toTop').fadeIn("fast");
                } else {
                    $('#toTop').stop().fadeOut("fast");
                }
            })
        })
    </script>
    @stack('scripts')
</body>
<html>
