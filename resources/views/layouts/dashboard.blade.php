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
                    <li>
                        <a class="sidebar_navlink {{ Route::is('purchase.orders') ? 'nav_active' : ''}}" href="{{ route('purchase.orders') }}">
                            <i class="fas fa-clipboard-list"></i><em>Purchase Orders</em>
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
                    @hasanyrole('client|vendor')
                    <li>
                        <a class="sidebar_navlink {{ Route::is('profile') ? 'nav_active' : ''}}" href="{{ route('profile') }}">
                            <i class="fas fa-user"></i><em>My Profile</em>
                        </a>
                    </li>
                    @endhasanyrole
                    <li>
                        <a class="sidebar_navlink {{ Route::is('activity.logs') ? 'nav_active' : ''}}" href="{{ route('activity.logs') }}">
                            <i class="fas fa-history"></i><em>Activity Logs</em>
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
    </div>0
    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSD1bBpEjkW1-JIdMdtL24qRkw7E2cWgE&callback=initMap"
    async defer></script>
</body>
</html>
