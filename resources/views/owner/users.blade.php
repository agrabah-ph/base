@extends('layouts.dashboard')

@section('content')
<div class="container">
    <a href="{{ route('user.add') }}" class="btn btn-lg btn-success mx-auto" id="add_user">
        Add New User <i class="fas fa-user-plus"></i>
    </a>
    <searchbar></searchbar>
    <users></users>
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
