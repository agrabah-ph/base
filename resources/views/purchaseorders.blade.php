@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <!-- PO Boost -->

        <!-- Expired POs > Renew -->
        <a href="{{ route('purchase.add') }}" class="btn btn-lg btn-success mx-auto" id="add_user">
            Add Order
        </a>
        <!-- Active POs -->
        <purchase-orders></purchase-orders>

    </div>
@endsection

<style>
#add_user {
    position:fixed;
    bottom:1em;
    left: 50%;
    transform: translateX(-50%);
}
</style>
