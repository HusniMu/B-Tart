<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-6 col-md-6 offset-md-6 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>Call US :- <a href="javascript:void()0;"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                            @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                        @else
                        <li class="dropdown">
                            <a href="javascript:void()0;" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->role_id == 1)
                                <li>
                                    <a href="{{route('admin.dashboard')}}">
                                        {{ Auth::user()->name }} <strong>Profile</strong>
                                    </a>
                                </li>
                                @elseif(Auth::user()->role_id == 2)
                                <li>
                                    <a href="{{route('member.dashboard')}}">
                                        {{ Auth::user()->name }} <strong>Profile</strong>
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{URL::asset('storage/images/logo.png')}}" class="logo" alt="" style="max-width:100%;max-height:75px;"></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about-us')}}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('customOrder')}}">Custom Order</a></li>
                    <li class="dropdown">
                        <a href="javascript:void()0;" class="nav-link dropdown-toggle" data-toggle="dropdown">Produk</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('categories')}}">Semua Kategori</a></li>
                            <li><a href="/posts">Semua Produk</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('how-to')}}">How To</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('faq')}}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact-us')}}">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    {{-- <li class="search"><a href="#"><i class="fa fa-search"></i></a></li> --}}
                    <li class="side-menu"><a href="{{ url('/cart') }}">
                    <i class="fa fa-shopping-bag"></i>
                        @if(Cart::instance('produk')->count()>0 || Cart::instance('cusPro')->count()>0)
                            <span class="badge">{{ Cart::instance('produk')->count() + Cart::instance('cusPro')->count() }}</span>
                            {{-- <span class="badge">{{ Cart::instance('cusPro')->count() }}</span> --}}
                        @else
                            <span class="badge">0</span>
                        @endif
                </a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->
