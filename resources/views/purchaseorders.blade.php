@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <purchase-orders></purchase-orders>

        <a href="{{ route('purchase.add') }}" class="btn btn-lg btn-success mx-auto" id="add_purchase_order">
            Add Purchase Order <i class="fas fa-plus"></i>
        </a>

    </div>
@endsection

<style>
#add_purchase_order {
    position:fixed;
    bottom:1em;
    left: 50%;
    transform: translateX(-50%);
}
@media only screen and (max-width: 320px) {
    #add_purchase_order {
        font-size: 11pt;
        padding: 5px;
    }
}
</style>
