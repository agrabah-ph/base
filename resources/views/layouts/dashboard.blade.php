<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agrabah Marketplace') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet" type="text/css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div id="app">
        <div class="dashboard_sidebar">
            <a href="#0" class="sidebar_trigger">
                <i class="fa fa-bars"></i>
            </a>
            <nav class="sidebar_nav">
                <ul>
                    <li>
                        <a class="sidebar_navlink {{ Route::is('home') ? 'nav_active' : ''}}" href="{{ route('home') }}">
                            <i class="fas fa-tachometer-alt"></i><em>Dashboard</em>
                        </a>
                    </li>
                    @role('owner')
                    <li>
                        <a class="sidebar_navlink {{ Route::is('manage.users') ? 'nav_active' : ''}}" href="{{ route('manage.users') }}">
                            <i class="fas fa-users-cog"></i><em>Manage Users</em>
                        </a>
                    </li>
                    @endrole
                    <li>
                        <a class="sidebar_navlink {{ Route::is('notifications') ? 'nav_active' : ''}}" href="{{ route('notifications') }}">
                            <i class="fas fa-bell"></i><em>Notifications</em>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar_navlink" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i><em>Log out</em>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
                <span>Agrabah Marketplace &copy;2019</span>
            </nav>
        </div>
        <main class="dashboard_content">
            @yield('content')
        </main>
    </div>
</body>
</html>
