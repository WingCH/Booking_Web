<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                    <title>
                        Room Booking
                    </title>
                    <!-- Fonts -->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
                            <!-- Styles -->
                            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
                                {{--
                                <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
                                    --}}
                                    <style>
                                        body {
                                            font-family: 'Lato';
                                            }
                                        .fa-btn {
                                            margin-right: 6px;
                                        }
                                    </style>
                                </link>
                            </link>
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>
    </head>
    <body id="app-layout">
        {{-- å¦admin navbaré» --}}
        @if (Auth::guest())
            <nav class="navbar navbar-default navbar-static-top">
        @else
            @if(Auth::user()->role === "admin")
                <nav class="navbar navbar-inverse navbar-static-top">
            @else
                <nav class="navbar navbar-default navbar-static-top">
            @endif
        @endif
                    <div class="container">
                        <div class="navbar-header">
                            <!-- Collapsed Hamburger -->
                            <button class="navbar-toggle collapsed" data-target="#app-navbar-collapse" data-toggle="collapse" type="button">
                                <span class="sr-only">
                                    Toggle Navigation
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                                <span class="icon-bar">
                                </span>
                            </button>
                            <!-- Branding Image -->
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <i aria-hidden="true" class="fa fa-home">
                                </i>
                                Room Booking
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <!-- Left Side Of Navbar -->
                            <ul class="nav navbar-nav">
                                @if (Auth::guest())
                                <li>
                                    <a href="{{ url('/history') }}">
                                        <i aria-hidden="true" class="fa fa-history">
                                        </i>
                                        History
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/idCard') }}">
                                        <i aria-hidden="true" class="fa fa-id-card-o">
                                        </i>
                                        ID Card
                                    </a>
                                </li>
                                @else
                                    @if(Auth::user()->role === "admin")
{{--                                         <li>
                                            <a href="{{ url('/bookingList') }}">
                                                All Room List
                                            </a>
                                        </li> --}}
                                    @else
                                        <li>
                                            <a href="{{ url('/history') }}">
                                                <i aria-hidden="true" class="fa fa-history">
                                                </i>
                                                History
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/idCard') }}">
                                                <i aria-hidden="true" class="fa fa-id-card-o">
                                                </i>
                                                ID Card
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                <li>
                                    <a href="{{ url('/login') }}">
                                        <i aria-hidden="true" class="fa fa-sign-in">
                                        </i>
                                        Login
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/register') }}">
                                        Register
                                    </a>
                                </li>
                                @else
                        @if(Auth::user()->role === "admin")
                                <li>
                                    <a href="{{ url('/addRoom') }}">
                                        <i aria-hidden="true" class="fa fa-plus-circle">
                                        </i>
                                        Add room
                                    </a>
                                </li>
                                @endif
                                <li class="dropdown">
                                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                        {{ Auth::user()->name }}
                                        <span class="caret">
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/logout') }}">
                                                <i class="fa fa-btn fa-sign-out">
                                                </i>
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </nav>
                @yield('content')
                <!-- JavaScripts -->
                <script src="/resources/jquery.min.js">
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js">
                </script>
                {{--
                <script src="{{ elixir('js/app.js') }}">
                </script>
                --}}
    @yield('js')
            </nav>
        </nav>
    </body>
</html>
