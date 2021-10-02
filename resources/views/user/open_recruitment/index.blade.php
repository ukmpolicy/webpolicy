@extends('user.layout')

@section('content')
<div id="introduction">
    <header>
        <div class="image">
            <img src="{{ asset('images/gallery/DSC_0111.JPG') }}" alt="">
        </div>
        <div class="text">
            <h1>OPEN RECRUITMENT</h1>
            <p>Mari Bergabung Dengan UKM-POLICY</p>
        </div>
    </header>
    <div class="container">
        <video src=""></video>
    </div>
</div>
@endsection

@section('d_script')
    <script src="{{ asset('js/page.js') }}"></script>
    <script>
        document.querySelector('#navbar').classList.add('scroll')
    </script>
@endsection