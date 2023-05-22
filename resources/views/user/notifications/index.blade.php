@extends('user.layouts.main')
@section('content')
    <div id="notifications">
        
        @forelse ($notifications as $notification)
        <div class="notification {{ (!is_null($notification->read_at)) ? 'new' : '' }}">
            <div class="status notification-icon">
                <i class="fa fa-circle"></i>
            </div>
            <div class="content">
                <div class="title">{{ $notifcation->title }}</div>
                <div class="subtitle">{{ $notifcation->content }}</div>
            </div>
            <div class="delete notification-icon">
                <i class="fa fa-trash"></i>
            </div>
        </div>
        @empty
        <div class="small text-capitalize text-center py-5 text-white" style="opacity: .5;">no notifications available</div>
        @endforelse
    </div>
@endsection