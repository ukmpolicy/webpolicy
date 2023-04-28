@extends('user.layouts.main')
@section('content')
    <div id="notifications">
        <div class="notification new">
            <div class="status notification-icon">
                <i class="fa fa-circle"></i>
            </div>
            <div class="content">
                <div class="title">From Server</div>
                <div class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus molestias quia maiores, sed enim sit.</div>
            </div>
            <div class="delete notification-icon">
                <i class="fa fa-trash"></i>
            </div>
        </div>
        @for ($i=0;$i<4;$i++)
            
        <div class="notification">
            <div class="status notification-icon">
                <i class="fa fa-circle"></i>
            </div>
            <div class="content">
                <div class="title">From Server</div>
                <div class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus molestias quia maiores, sed enim sit.</div>
            </div>
            <div class="delete notification-icon">
                <i class="fa fa-trash"></i>
            </div>
        </div>
        @endfor
    </div>
@endsection