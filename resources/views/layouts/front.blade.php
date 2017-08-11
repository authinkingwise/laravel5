<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-euiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width,intial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Agency Bucket - @yield('title')</title>
        @section('style')
        <!-- <link rel="stylesheet" href="{{ asset('/static/font-awesome/css/font-awesome.min.css') }}"> -->
        <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
        @show

        <script type="text/javascript" src="{{ asset('/js/jquery/jquery-3.2.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/global.js') }}"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Agency Bucket') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Contact</a></li>
                        @if (Auth::guest())
                            <li><a href="{{-- route('login') --}}">Login</a></li>
                            <li><a href="{{-- route('register') --}}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        @yield('content')


        <footer class="footer">
            <div class="container">
                <p>&copy;2017 Agency Bucket</p>
            </div>
        </footer>

        <!-- Scripts -->
        @section('javascript')
            
            <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
            <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @show
    </body>
</html>
