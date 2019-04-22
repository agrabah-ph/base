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
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="/home"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
        </nav>

        <main class="container">
            <div class="card mr-auto ml-auto mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <h5 class="card-title">{{ $order->user->name }}</h5>
                            <p class="card-text">
                                {{ $order->note }}
                            </p>
                        </div>
                        <div class="col-md-5">
                            <ul class="list-group list-group-flush">
                                <header>
                                    <h5>Items</h5>
                                </header>
                                @foreach ($order->items as $item)
                                    <li class="list-group-item d-flex justify-content-between"><p>{{ $item->item }}</p><p> {{ $item->quantity }}Kg</p></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @role("vendor|owner")
                        <a href="" class="btn btn-primary">Bid</a>
                    @endrole

                    @if(Auth::user())
                        <a href="" class="btn btn-warning">Edit</a>
                        <form action="/order/{{ $order->id }}" class="d-inline">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Close Bidding" class="btn btn-success">
                        </form>
                    @endif
                </div>

            </div>
        </main>
    </div>
</body>
</html>
