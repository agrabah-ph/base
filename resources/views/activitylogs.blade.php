@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Activity Logs</div>

                <div class="card-body">
                    @if(count($loginActivities))
                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>User Agent</th>
                                <th>Ip Address</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loginActivities as $loginActivity)
                            <tr>
                                <td>{{ $loginActivity->user_agent }}</td>
                                <td>{{ $loginActivity->ip_address }}</td>
                                <td>{{ $loginActivity->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
