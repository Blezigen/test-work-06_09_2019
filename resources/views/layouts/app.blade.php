<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"
          integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

</head>
<body>
<section class="header" style="background: red">
    <div class="container">
        <div class="title m-b-md">
            <a href="{{ route('home') }}"><img src="{{ asset("img/logo.png") }}" style="width: 200px;"
                                               alt="{{ config('app.name', 'Laravel') }}"></a>
        </div>
    </div>
</section>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
        <div class="container">
            <div class="collapse navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav" style="margin: 0 auto;">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                    </li>
                    @guest
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/profile') }}">{{ __('Setting') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
    <main class="py-4">
        @yield('content')
    </main>
</div>
<!-- jQuery & Bootstrap -->
<script src="{{ asset("js/jquery-3.4.1.min.js") }}"></script>
<script src="{{ asset("js/popper.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("js/BsMultiSelect.min.js") }}"></script>

@yield('endScript')

</body>
</html>
