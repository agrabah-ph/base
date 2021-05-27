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

    @hasrole(" vendor|owner ")
    <div class="row justify-content-center mt-3">
        Orders | Client, Vendor, owner |
        <client-orders :user="{{ json_encode(Auth::user()) }}"></client-orders>
    </div>
    @endrole
</div>
@endsection
