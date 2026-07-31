<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dream Nest') - Dream Nest</title>
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    @stack('head')
</head>
<body>
    <nav>
        <img class="logo1" alt="Logo" src="{{ asset('images/logo2.png') }}">
        <div class="nav-link">
            <ul>
                <li><a class="nav" href="{{ route('home') }}">HOME</a></li>
                <li><a class="nav" href="{{ route('sale') }}">SALES</a></li>
                <li><a class="nav" href="{{ route('rent') }}">RENTALS</a></li>
                @if(Auth::check())
                    <li><a class="nav" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
               
                @if (Auth::check() && Auth::user()->isAdmin())
                    <li><a class="nav" href="{{ route('admin.index') }}">DASHBOARD</a></li>
                @endif
                
               
                @if (!Auth::check())
                    <li><a class="nav" href="{{ route('login') }}">LOGIN</a></li>
                    <li><a class="nav" href="{{ route('register') }}">REGISTER</a></li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container3">
            <div class="top">
                <div class="logo-details">
                    <span class="logo_name">DREAM NEST - Your sanctuary for serene living</span>
                </div>
                <div class="media-icons">
                    <a href="https://web.facebook.com/login/?_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/i/flow/login?redirect_after_login=%2F%3Flang%3Den"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="link-boxes">
                <ul class="box">
                    <li class="link_name">Company</li>
                    <li><a href="#">Dream Nest</a></li>
                    <li><a href="#">Colombo 7, Sri Lanka</a></li>
                    <li><a href="#">dreamnest.property.com</a></li>
                    <li><a href="#">dreamnest.property@gmail.com</a></li>
                    <li><a href="#">+94 76 310 7113</a></li>
                </ul>
                <ul class="box">
                    <li class="link_name">Sales</li>
                    <li>Home</li>
                    <li>Apartments</li>
                    <li>Commercial Buildings</li>
                    <li>Villas</li>
                </ul>
                <ul class="box">
                    <li class="link_name">Rentals</li>
                    <li>Home</li>
                    <li>Apartments</li>
                    <li>Commercial Buildings</li>
                    <li>Villas</li>
                </ul>
            </div>
        </div>
        <div class="bottom-details">
            <div class="bottom_text">
                <span class="copyright_text">Copyright &copy; 2023 <a href="#">Dream Nest</a> All rights reserved for IIT Advanced Client-Side Web Development</span>
                <span class="policy_terms">
                    <a href="#">Privacy policy</a>
                    <a href="#">Terms & condition</a>
                </span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('script.js') }}"></script>
    @stack('scripts')
</body>
</html>
