<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('mainassets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('mainassets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('mainassets/css/style.min.css') }}" rel="stylesheet">

</head>

<body>

<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="">About</a>
                <a class="text-body mr-3" href="{{ route('feedback.create') }}">Contact</a>
                <a class="text-body mr-3" href="">Help</a>
                <a class="text-body mr-3" href="">FAQs</a>
            </div>
        </div>

        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">

                <!-- My Account Dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                        My Account
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        @if(auth()->check())
                            <span class="dropdown-item-text">Hello, {{ auth()->user()->name }}</span>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        @else
                            <a class="dropdown-item" href="{{ route('login') }}">Sign in</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Sign up</a>
                        @endif
                    </div>
                </div>

                <!-- Currency -->
                <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EUR</button>
                        <button class="dropdown-item" type="button">GBP</button>
                        <button class="dropdown-item" type="button">CAD</button>
                    </div>
                </div>

                <!-- Language -->
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">FR</button>
                        <button class="dropdown-item" type="button">AR</button>
                        <button class="dropdown-item" type="button">RU</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->



<!-- Navbar Start -->
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">

        <!-- Categories -->
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100"
               data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">

                <h6 class="text-dark m-0">
                    <i class="fa fa-bars mr-2"></i>Categories
                </h6>

                <i class="fa fa-angle-down text-dark"></i>
            </a>

            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start 
                        p-0 bg-light"
                 id="navbar-vertical"
                 style="width: calc(100% - 30px); z-index: 999;">

                <div class="navbar-nav w-100">

                    @foreach ($allCategories as $cat)
                        <a href="{{ route('shop', ['category' => $cat->name]) }}"
                           class="nav-item nav-link">
                            {{ $cat->name }}
                        </a>
                    @endforeach

                </div>
            </nav>
        </div>

        <!-- Main Navbar -->
        <div class="col-lg-9">

            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">

                <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                        <a href="{{ route('blog') }}" class="nav-item nav-link">Blog</a>
                        <a href="{{ route('feedback.create') }}" class="nav-item nav-link">Contact</a>
                        <a href="{{ route('my.orders') }}" class="nav-item nav-link">My-Orders</a>
                    </div>

                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle"
                                  style="padding-bottom: 2px;">0</span>
                        </a>

                        <a href="{{ route('cart.index') }}" class="btn px-0 ml-3">
                            <i class="fas fa-shopping-cart text-primary"></i>

                            <span class="badge text-secondary border border-secondary rounded-circle"
                                  style="padding-bottom: 2px;">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>
                    </div>

                </div>
            </nav>
        </div>

    </div>
</div>
<!-- Navbar End -->


@yield('home-content')
@yield('shop-content')
@yield('blog-content')
@yield('cart-content')
@yield('contact-content')
@yield('detail-content')
@yield('checkout-content')
@yield('thankyou-content')
@yield('editprofile')
@yield('order-view')



<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5">

    <div class="row px-xl-5 pt-5">

        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
            <p class="mb-4">No dolore ipsum accusam no lorem...</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, NY, USA</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="row">

                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                      <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}"><i class="fa fa-angle-right mr-2"></i>Shop</a>
                        <a class="text-secondary mb-2" href="{{ route('cart.index') }}"><i class="fa fa-angle-right mr-2"></i>Cart</a>
                        <a class="text-secondary" href="{{ route('feedback.create') }}"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}"><i class="fa fa-angle-right mr-2"></i>Shop</a>
                        <a class="text-secondary mb-2" href="{{ route('cart.index') }}"><i class="fa fa-angle-right mr-2"></i>Cart</a>
                        <a class="text-secondary" href="{{ route('feedback.create') }}"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                    <p>Subscribe for updates</p>
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your Email Address">
                            <div class="input-group-append">
                                <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                            </div>
                        </div>
                    </form>

                  
                </div>

            </div>
        </div>

    </div>

    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(255,255,255,.1)!important;">
        <div class="col-md-6 text-center text-md-left">
            <p class="mb-md-0 text-secondary">
                &copy; <a class="text-primary">Domain</a>. All Rights Reserved. Designed by HTML Codex
            </p>
        </div>
        <div class="col-md-6 text-center text-md-right">
            <img class="img-fluid" src="{{ asset('mainassets/img/payments.png') }}" alt="">
        </div>
    </div>

</div>
<!-- Footer End -->


<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('mainassets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('mainassets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('mainassets/js/main.js') }}"></script>

</body>
</html>
