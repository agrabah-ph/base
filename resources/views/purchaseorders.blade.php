@extends('layouts.dashboard')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Purchase Orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <p>
                        {{ ucfirst(Auth::user()->name) }}
                    </p>

                </div>
            </div>
        </div>
    </div> --}}

    <purchase-orders></purchase-orders>
</div>
@endsection
