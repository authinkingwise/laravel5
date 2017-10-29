<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-euiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config('app.name', 'Agency Bucket') }} - @yield('title')</title>
        @section('style')
        <link rel="stylesheet" href="{{ asset('js/jquery/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
        @show

        <script type="text/javascript" src="{{ asset('/js/jquery/jquery-3.2.1.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/bootstrap/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/jquery/jquery-ui.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ asset('/js/jquery/timepicker/jquery.timepicker.js') }}"></script> -->
        <script type="text/javascript" src="{{ asset('/js/chart/Chart.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/chart/utils.js') }}"></script>
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
                        <li @if(Request::getPathInfo() == '/projects') class="active" @endif><a href="{{ url('projects') }}"><i class="fa fa-tasks"></i><span>Projects</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/tickets') class="active" @endif><a href="{{ url('mytickets') }}"><i class="fa fa-free-code-camp"></i><span>Tickets</span></span></a></li>
                    </ul>

                    <ul class="nav nav-sidebar">
                        @can('show-account')
                            <li @if(Request::getPathInfo() == '/accounts') class="active" @endif><a href="{{ url('accounts') }}"><i class="fa fa-diamond"></i><span>Accounts</span></span></a></li>
                        @endcan
                        @can('show-contact')
                            <li @if(Request::getPathInfo() == '/contacts') class="active" @endif><a href="{{ url('contacts') }}"><i class="fa fa-chain-broken"></i><span>Contacts</span></span></a></li>
                        @endcan
                    </ul>

                    @can('show-user')
                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/users') class="active" @endif><a href="{{ url('users') }}"><i class="fa fa-user-plus"></i><span>Users</span></a></li>
                    </ul>
                    @endcan

                    @can('tenant-owner')
                    <ul class="nav nav-sidebar">
                        <li><a href="{{ url('settings') }}"><i class="fa fa-gears"></i><span>Settings</span></a></li>
                    </ul>
                    @endcan

                    @can('show-role', Auth::user()->roles->first())
                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/roles') class="active" @endif><a href="{{ url('roles') }}"><i class="fa fa-key"></i><span>Roles</span></a></li>
                    </ul>
                    @endcan 

                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/reports') class="active" @endif><a href="{{ url('reports') }}"><i class="fa fa-bar-chart"></i><span>Reports</span></a></li>
                    </ul>

                    @can('site-admin')
                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/permissions') class="active" @endif><a href="{{ url('permissions') }}"><i class="fa fa-shield"></i><span>Permissions</span></a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li @if(Request::getPathInfo() == '/site/tenants') class="active" @endif><a href="{{ url('site/tenants') }}"><i class="fa fa-bed"></i><span>Tenants</span></a></li>
                    </ul>
                    @endcan

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
                                    <li class="hidden-xs"><a href="{{ url('tickets/create') }}" class="btn btn-sm btn-skyblue" title="Add Ticket"><i class="fa fa-plus"></i><span>Add Ticket</span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" title="Notifications">
                                            <i class="fa fa-bell-o"></i>
                                            <span class="badge badge-sm up bg-danger pull-right-xs">0</span>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="{{ Auth::user()->name }}">
                                            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                                                <span class="name-init bg-danger">
                                                    @isset(Auth::user()->avatar)
                                                        <img src="{{ asset('storage/profile') }}/{{ Auth::user()->tenant_id }}/{{ Auth::id() }}/{{ Auth::user()->avatar }}" class="img-circle m-t-xs img-responsive">
                                                    @else
                                                        <img src="{{ asset('/images/letter-a.png') }}" class="img-circle m-t-xs img-responsive">
                                                    @endisset
                                                </span>
                                                <i class="on md b-white bottom"></i>
                                            </span>
                                            <span class="hidden hidden-sm hidden-md">{{ Auth::user()->name }}</span> <b class="caret"></b>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ url('profile') }}" title="Name" alt="Name">Profile</a>
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

        <div class="ajax-loader" style="display:none;">
            <img src="{{ asset('/images/ajax-loader.gif') }}" class="loading-indicator">
        </div>

        <!-- Scripts -->
        @section('javascript')
            <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> -->
            <script type="text/javascript" src="{{ asset('js/back.js') }}"></script>
        @show
    </body>
</html>
