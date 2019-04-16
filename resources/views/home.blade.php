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

    @hasrole(" client|owner ")
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card m-auto">
                    <div class="card-header">
                        Order | Client and owner
                    </div>
                    <add-order></add-order>
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endrole

    @hasrole(" vendor|owner ")
    <div class="row justify-content-center mt-3 ">
        <div class="col-md-10">
            <div class="card m-auto">
                <div class="card-header">
                    Order Lists | Vendor and Owner
                </div>
                <client-orders></client-orders>
            </div>
        </div>
    </div>
    @endrole
</div>
@endsection
