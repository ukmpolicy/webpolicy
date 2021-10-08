<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/policy.png') }}" type="image/x-icon">
    @include('user.includes.style')
    <link rel="canonical" href="{{ route('main.home') }}">
    @yield('d_style')
</head>

<body>

    <!-- <div id="flash-load"> -->
    <!-- <img src="assets/images/illustrator/feeling.svg" alt=""> -->
    <!-- </div> -->

    <div id="topArrow" class="d-md-flex d-none">
        <i class="fa fa-angle-up"></i>
    </div>

    {{-- navbar --}}
    @include('user.includes.navbar')

    @yield('content')

    {{-- about us --}}
    @yield('aboutUs')

    {{-- visi --}}
    @yield('visi')

    {{-- misi --}}
    @yield('misi')
    
    {{-- strucktur --}}
    @yield('Structural')

    {{-- footer --}}
    @include('user.includes.footer')
    
    {{-- scripit --}}
    @include('user.includes.script')

    {{-- default script --}}
    @yield('d_script')


    

</body>

</html>