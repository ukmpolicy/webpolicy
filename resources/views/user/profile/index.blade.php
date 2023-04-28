@extends('user.layouts.main')
{{-- @section('header')
@include('guest.includes.main_header')
@endsection --}}
@section('content')
    <div id="profile">
        <div class="banner">

            <div class="picture">
                <img src="https://images.unsplash.com/photo-1618614944895-fc409a83ad80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8MSUzQTF8ZW58MHx8MHx8&w=1000&q=80" alt="">
            </div>
        </div>
        <div class="bio">
            <h3 class="text-capitalize">{{ $user->name }}</h3>
            <div class="d-flex align-items-center" style="width: 100%">
                <div style="margin-right: .5rem"><i class="fa fa-envelope"></i></div>
                <div class="small">{{ $user->email}}</div>
            </div>
            <div class="bio-quote">
                <div class="bio-icon">
                    <i class="fa fa-quote-left"></i>
                </div>
                <div class="bio-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, minus omnis! Nemo necessitatibus veniam molestias, consectetur fugiat sit quibusdam deleniti officiis ut. Totam possimus praesentium recusandae quos soluta sapiente velit!</div>
            </div>
        </div>
    </div>
@endsection