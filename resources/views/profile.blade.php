@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    {{-- @foreach(Auth::user()->getRoleNames() as $role)
                    {{$role}}
                    @endforeach --}}
                    <user-profile :user="{{ json_encode(Auth::user()) }}"></user-profile>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
