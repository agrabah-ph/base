@extends('layouts.dashboard')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div> --}}

    @hasrole(" client|mod|'' ")
        Client and Mod
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card m-auto">
                    <div class="card-header">
                        Order
                    </div>
                    <add-order></add-order>
                </div>
            </div>
        </div>
    @else
        Vendor and Mod
    @endrole
</div>
@endsection
