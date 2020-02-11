<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />

    <title>{{ config('app.name', 'MARCATTO') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.MARCATTO = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
                        {{ config('app.name', 'MARCATTO') }}
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
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                        @else
                            @if(Auth::User()->user_type == 'admin')
                                <li><a href="{{ url('/AdminHome') }}"><img src="{{asset('images/home.png')}}" width="20px">&nbsp Home</a></li>
                                <li><a href="{{ url('/BasicSettings') }}"><img src="{{asset('images/settings.png')}}" width="20px">&nbsp Configuración</a></li>
                            @elseif(Auth::User()->user_type == 'supervisor')
                                <li><a href="{{ url('/SupervisorHome') }}"><img src="{{asset('images/home.png')}}" width="20px">&nbsp Home</a></li>
                                <li><a href="{{ url('/SupervisorSettings') }}"><img src="{{asset('images/settings.png')}}" width="20px">&nbsp Configuración</a></li>
                            @elseif(Auth::User()->user_type == 'employee')
                                <li><a href="{{ url('/EmployeeHome') }}"><img src="{{asset('images/home.png')}}" width="20px">&nbsp Home</a></li>
                                <li><a href="{{ url('/EmployeeSettings') }}"><img src="{{asset('images/settings.png')}}" width="20px">&nbsp Configuración</a></li>
                            @endif
                                <li><a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <img src="{{asset('images/user.png')}}" width="20px">&nbsp Logout ({{ Auth::user()->name }})
                                    </a></li>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
