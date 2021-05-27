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
            <a class="navbar-brand" href="{{ route('purchase.orders') }}"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Back</a>
        </nav>
        <main>
            <div class="container p-3">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-md-6">
                                    <h5>
                                        {{ ucwords($order->user->name) }}
                                    </h5>
                                    <p class="m-0">Company name</p>
                                    <small>{{ $order->user->address }}</small>
                                </div>
                                <div class="text-right col-md-6">
                                    <span style="font-size: 12pt;"><i class="fas fa-caret-down"></i></span>
                                    <br>
                                    <small>
                                        Bid end date: {{ date("D, M/d/Y h:i A", strtotime($order->bid_end_date)) }}
                                    </small>
                                    <p>
                                        Status:
                                        @if($order->ended)
                                            <span class="text-danger">Expired</span>
                                        @else
                                            <span class="text-success">Active</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $order->description }}</p>
                                <ul>
                                @foreach ($order->items as $item)
                                    <li>{{ $item->item }} {{ $item->quantity."Kg" }}</li>
                                @endforeach
                                </ul>
                                <small class="mt-auto mb-auto">
                                    Posted on: {{ date("D, M/d/Y h:i A", strtotime($order->created_at)) }}
                                </small>
                            </div>
                            <div class="card-body">
                                @if(!$order->bids->count())
                                    <strong class="text-center">No bids yet</strong>
                                @else
                                    <div class="d-flex justify-content-between">
                                        <h4>Bids</h4>
                                        <p class="mt-auto mb-auto">Bidders: {{ $order->bids->count() }}</p>
                                    </div>
                                    <po-bids :bids="{{ $order->bids }}"></po-bids>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
