<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
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
                    <div style="font-size: 22px" class="text-white text-center my-3">Sign in to POLICY</div>
                </div>
                <div class="p-3 rounded text-white shadow mb-3" style="background-color: #151515">

                    {{-- Failed Message --}}
                    @if (session('error'))
                    <div class="p-2 text-center text-danger small rounded mb-3" style="border: 1px solid rgba(255, 255, 255, .2); background: rgba(255, 255, 255, .02)">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        {{-- Email --}}
                        <div class="form-group mb-2">
                            <label class="mb-1" for="email">{{ __('Email Address') }}</label>
                            <input type="text" id="email" name="email" class="inp form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group mb-2">
                            <div style="justify-content: space-between; display: flex; align-items: center;">
                                <label for="password">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <input type="password" id="password" class="inp form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group">
                            <button class="btn btn-sm w-100 btn-danger">{{ __('Login') }}</button>
                        </div>

                    </form>
                </div>
                <div class="p-3 text-white mb-5 rounded text-center" style="border: 1px solid rgba(255, 255, 255, .2)">
                    New to POLICY? <a href="{{ route('register') }}">Create an account</a>.
                </div>
                <div class="text-center small" style="color: #fafafa70">Copyright ©2021 Polytechnic Linux Community.</div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>