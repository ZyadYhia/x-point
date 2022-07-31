<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>X-POINTS: @yield('title')</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/style.css') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    @yield('styles')
</head>

<body>
    <form style="display: none;" id="logout-form" action="{{ url('logout') }}" method="post">@csrf</form>

    <!-- Header -->
    <header id="header">
        <div class="container">

            <div class="navbar-header">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a class="logo" href="index.html">
                        <img src="{{ asset('web/img/logo.png') }}" alt="logo">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Mobile toggle -->
                <button class="navbar-toggle">
                    <span></span>
                </button>
                <!-- /Mobile toggle -->
            </div>

            <!-- Navigation -->
            <nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">
                    <li><a href="index.html">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Air Hocky</a></li>
                            <li><a href="#">Pool</a></li>
                            <li><a href="#">Playstation</a></li>
                            <li><a href="#">Cafe</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('contact') }}">Contact</a></li>
                    {{-- @auth
                        <li><a href="{{ url('login') }}">Sign In</a></li>
                        <li><a href="{{ url('register') }}">Sign Up</a></li>
                    @endauth --}}
                    @guest
                        <li><a href="{{ url('login') }}">{{ __('web.signin') }}</a></li>
                        <li><a href="{{ url('register') }}">{{ __('web.signup') }}</a></li>
                    @endguest
                    @auth
                        {{-- @if (Auth::user()->role->name == 'client') --}}
                            <li><a href="{{ url('dashboard') }}">{{ __('web.dashboard') }}</a></li>
                        {{-- @endif --}}
                        <li><a id="logout-link" href="">{{ __('web.signout') }}</a></li>
                    @endauth
                </ul>
            </nav>
            <!-- /Navigation -->

        </div>
    </header>
    <!-- /Header -->
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.html">Home</a></li>
                        <li>Contact</li>
                    </ul>
                    <h1 class="white-text">Get In Touch</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->
    @yield('main')

    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/cta.jpg') }})"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">Contact Us</h2>
                    <p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
                    <a class="main-button icon-button" href="contact.html">Contact Us Now</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->

    <!-- Footer -->
    <footer id="footer" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div id="bottom-footer" class="row">

                <!-- social -->
                <x-contact></x-contact>
                <!-- /social -->

                <!-- copyright -->
                <div class="col-md-8 col-md-pull-4">
                    <div class="footer-copyright">
                        <span>&copy; Copyright 2021. All Rights Reserved. | Made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="#">SkillsHub</a></span>
                    </div>
                </div>
                <!-- /copyright -->

            </div>
            <!-- row -->

        </div>
        <!-- /container -->

    </footer>
    <!-- /Footer -->

    <!-- preloader -->
    <div id='preloader'>
        <div class='preloader'></div>
    </div>
    <!-- /preloader -->

    <!-- jQuery Plugins -->
    <script type="text/javascript" src="{{ asset('web/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>

    <script>
        $("#logout-link").click(function(e) {
            e.preventDefault();
            $("#logout-form").submit();
        });
    </script>
    @yield('scripts')
</body>

</html>
