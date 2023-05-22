@extends('user.layouts.main')
{{-- @section('header')
@include('guest.includes.main_header')
@endsection --}}
@section('content')
    <div id="profile">
        <div class="picture">
            <img src="{{ $user->getPicture() }}" alt="{{ $user->name }}">
        </div>
        <div class="bio">
            <h3 class="text-capitalize mb-0">{{ $user->name }}</h3>
            <div class="mt-0" style="opacity: .5;">{{ $user->username}}</div>
            <div class="bio-quote">
                <div class="bio-icon">
                    <i class="fa fa-quote-left"></i>
                </div>
                <div class="bio-text">{{ $user->bio }}</div>
            </div>
        </div>
    </div>
@endsection