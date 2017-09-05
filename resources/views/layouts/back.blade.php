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
                
                <div class="col-sm-3 col-md-2 sidebar collapse" id="sidebar">
                    
                    <a class="brand hidden-xs" href="{{ url('/') }}">
                        {{ config('app.name', 'Agency Bucket') }}
                    </a>

                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/dashboard') class="active" @endif><a href="{{ url('dashboard') }}"><i class="fa fa-desktop"></i><span>Dashboard</span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('workflow') }}"><i class="fa fa-tasks"></i><span>Workflow</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/ticket') class="active" @endif><a href="{{ url('ticket') }}"><i class="fa fa-free-code-camp"></i><span>Tickets</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('account') }}"><i class="fa fa-diamond"></i><span>Accounts</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('user') }}"><i class="fa fa-user-plus"></i><span>Users</span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('settings') }}"><i class="fa fa-gears"></i><span>Settings</span></a></li>
                    </ul>

                </div>

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    
                    <div class="row nav-wrap">
                        <div class="container-fluid">
                            <nav class="navbar-top" role="navigation">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                {{--
                                <div class="navbar-header pull-left">
                                    <span class="search"><i class="fa fa-search"></i></span>
                                </div>
                                --}}
                                <ul class="nav-links pull-right">
                                    <li class="hidden-xs"><a href="#" class="btn btn-sm btn-skyblue" title="Add Ticket"><i class="fa fa-plus"></i><span>Add Ticket</span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" title="Notifications">
                                            <i class="fa fa-bell-o"></i>
                                            <span class="badge badge-sm up bg-danger pull-right-xs">0</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                                                <span class="name-init bg-danger">
                                                    <img src="{{ asset('/images/a7.jpg') }}" class="img-circle m-t-xs img-responsive">
                                                </span>
                                                <i class="on md b-white bottom"></i>
                                            </span>
                                            <span class="hidden hidden-sm hidden-md">Darren Li</span> <b class="caret"></b>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('setting/profile') }}" title="Name" alt="Name">Profile</a>
                                            </li>
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
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="main-content-wrap">
                        <div class="container-fluid">

                            @yield('content')

                        </div>
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
