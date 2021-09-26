@extends('layouts.hompage')

@section('content')
    <section id="events">
        <!-- <div class="notFound">
            <img src="assets/images/illustrator/feeling.svg" alt="">
        </div> -->
        <div class="container">
            <div class="head">
                <h2>EVENTS</h2>
                <div class="devider"></div>
            </div>
            <div class="items">
                @foreach ($events as $event)
                    <a href="{{ url('event/'.$event->slug) }}" class="item">
                        <div class="image">
                            <img src="{{ asset('gambar/event/' . $event->thumbnail) }}" alt="thumbnail">
                        </div>
                        <div class="body">
                            <div class="wrap">
                                <div class="title">{{ $event->title }}</div>
                                <div class="meta">
                                    <div class="date">
                                        @php 
                                            echo date('l, d M Y', strtotime($event->expired_at));
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="more">
                <i class="fa fa-plus-circle fa-fw"></i> Show More.
            </div>
        </div>
    </section>

@endsection
