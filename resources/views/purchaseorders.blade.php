@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <purchase-orders></purchase-orders>

        <a href="{{ route('purchase.add') }}" class="btn btn-lg btn-success mx-auto" id="add_user">
            Add Order
        </a>

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
