<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gray Paw | Animal shelter</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a href="{{ url('/') }}">
        
                <img style="height: 50px; max-width: 70px;"class="img-thumbnail rounded-circle mx-auto d-block hover-overlay ripple shadow-1-strong " src={{asset("images/pawlogo.png")}} alt="Logo"/>
                </a>
                <a style="padding-left: 1rem;" class="navbar-brand " href="{{ url('/') }}">
                    Animal Shelter of Gray Paw
                </a>

                <ul class="list-group list-group-horizontal flex-reverse">
                    <a style="text-decoration: none;" href="{{ url('/') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">Home</li></a>
                    @auth 
                    @if(Auth::user()->role == "admin")
                    <a style="text-decoration: none;" href="{{ url('/admin') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">Manage</li></a>
                    @endif
                    @if(Auth::user()->role == "vet")
                    <a style="text-decoration: none;" href="{{ url('/vet') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">Manage</li></a>
                    @endif
                    @if(Auth::user()->role == "careman")
                    <a style="text-decoration: none;" href="{{ url('/careman/requests') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">Manage</li></a>
                    @endif
                    @if(Auth::user()->role == "volunteer")
                    <a style="text-decoration: none;" href="{{ url('/volunteer') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">Manage</li></a>
                    @endif
                    @endauth
                    <a style=" text-decoration: none;" href="{{ url('/about') }}"><li style="margin-right: 1rem; color: rgb(47, 103, 193);"class="list-group-item list-group-item-info">About</li></a>
                </ul>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role == "admin")
                                    <i class="dropdown-header">View as</i>
                                    <a class="dropdown-item" href="/admin">
                                        {{ __('Admin') }}
                                    </a>
                                    <a class="dropdown-item" href="/vet">
                                        {{ __('Vet') }}
                                    </a>
                                    <a class="dropdown-item" href="/careman/requests">
                                        {{ __('Careman') }}
                                    </a>
                                    <a class="dropdown-item" href="/volunteer">
                                        {{ __('Volunteer') }}
                                    </a>
                                    <hr class="dropdown-divider"></hr>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
