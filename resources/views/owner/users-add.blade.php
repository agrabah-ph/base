<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agrabah Marketplace') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="{{ route('manage.users') }}"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Cancel</a>
        </nav>
        <main>
            <div class="container p-3">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register a User</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.create') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                        <div class="col-md-6">
                                            <select name="role" id="role" class="custom-select form-control{{ $errors->has('role') ? ' is-invalid' : ''}}" required>
                                                <option value="" selected>Choose a role</option>
                                                <option value="client">Client</option>
                                                <option value="vendor">Vendor</option>
                                                <option value="mod">Moderator</option>
                                            </select>

                                            @if ($errors->has('role'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <user-location
                                        :province_error="{{ json_encode($errors->first('province')) }}"
                                        :municipality_error="{{ json_encode($errors->first('municipality')) }}"
                                        :barangay_error="{{ json_encode($errors->first('barangay')) }}"
                                        :addln_error="{{ json_encode($errors->first('address_line_1')) }}">
                                    </user-location>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary mt-3 mb-3">
                                                Register
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
