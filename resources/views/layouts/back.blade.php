<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-euiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width,intial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config('app.name', 'Agency Bucket') }} - @yield('title')</title>
        @section('style')
        <!-- <link rel="stylesheet" href="{{ asset('/static/font-awesome/css/font-awesome.min.css') }}"> -->
        <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
        @show

        <script type="text/javascript" src="{{ asset('/js/jquery/jquery-3.2.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/global.js') }}"></script>
    </head>
    <body id="app">
        <div class="container-fluid">
            
            <div class="row">
                
                <div class="col-sm-3 col-md-2 sidebar">
                    
                    <a class="brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Agency Bucket') }}
                    </a>

                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="{{ url('dashboard') }}"><i class="fa fa-desktop"></i><span>Dashboard</span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('workflow') }}"><i class="fa fa-tasks"></i><span>Workflow</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('ticket') }}"><i class="fa fa-free-code-camp"></i><span>Tickets</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('user') }}"><i class="fa fa-user-plus"></i><span>Users</span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('settings') }}"><i class="fa fa-gears"></i><span>Settings</span></a></li>
                    </ul>

                </div>

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    
                    <div class="container-fluid">

                        <nav class="navbar">

                        </nav>

                        @yield('content')

                    </div>

                </div>

            </div>

        </div>

        {{-- @yield('content') --}}

        <footer class="footer">
            <div class="container text-center">
                <p>Copyright &copy;2017 Agency Bucket. All rights reserved.</p>
            </div>
        </footer>

        <!-- Scripts -->
        @section('javascript')
            <script type="text/javascript" src="{{ asset('js/front.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @show
    </body>
</html>
