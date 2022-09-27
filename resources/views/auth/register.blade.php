<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body class="auth bg-dark">
    <div class="container m-auto">
        <div class="row">
            <div class="col-lg-4 m-auto py-3">
                <div class="m-auto">
                    <div style="margin: 0 auto; width: 100px; height: 100px;background-color: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;border: 2px solid #151515">
                        <img src="{{ asset('images/policy.png') }}" alt="logo policy" height="64px">
                    </div>
                    <div style="font-size: 22px" class="text-white text-center mt-3">Sign up to POLICY</div>
                    <p class="small text-white-50 mb-3 text-center">Welcome to POLICY, let's join with us.</p>
                </div>
                <div class="p-3 rounded text-white shadow mb-3" style="background-color: #151515">

                    <form action="{{ route('register') }}" method="post">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group mb-2">
                            <label class="mb-1" for="name">{{ __('Name') }}</label>
                            <input type="text" class="inp form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group mb-2">
                            <label class="mb-1" for="email">{{ __('Email Address') }}</label>
                            <input type="text" class="inp form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group mb-3">
                            <label class="mb-1" for="password">{{ __('Password') }}</label>
                            <input type="password" class="inp form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group mb-3">
                            <label class="mb-1" for="cpassword">{{ __('Confirm Password') }}</label>
                            <input type="password" class="inp form-control-sm" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        {{-- Submit --}}
                        <div class="form-group">
                            <button class="btn btn-sm w-100 btn-danger">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
                <div class="p-3 text-white mb-5 rounded text-center" style="border: 1px solid rgba(255, 255, 255, .2)">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>.
                </div>
                <div class="text-center small" style="color: #fafafa70">Copyright ©2021 Polytechnic Linux Community.</div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>