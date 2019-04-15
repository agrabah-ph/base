@extends('layouts.dashboard')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">
                    @foreach(Auth::user()->getRoleNames() as $role)
                    {{$role}}
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}
    {{ Auth::user()->roles }}
    <user-profile :user="{{ json_encode(Auth::user()) }}"></user-profile>
</div>
@endsection
