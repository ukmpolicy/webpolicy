@extends('user.layout')
@section('header')
@include('user.includes.main_header')
@endsection
@section('content')
    <section id="documentation">
        <!-- <div class="notFound">
            <img src="assets/images/illustrator/feeling.svg" alt="">
        </div> -->
        <div class="container">
            <div class="head mb-5">
                <h2>DOCUMENTATION</h2>
                <div class="devider"></div>
            </div>
            @foreach ($events as $event)
            <div class="mb-3 d-flex align-items-center">
                <div><i class="fa fa-angle-double-right" style="margin-right: .5rem;font-size: 23px"></i></div>
                <h4 class="text-capitalize">{{ $event['name'] }}</h4>
            </div>
            <div class="items">
                @foreach ($event['docs'] as $doc)
                    <a data-gall="gal1" class="venobox" data-title="{{ $doc['description'] }}" href="{{ asset($doc['source']->path) }}">
                        <div class="image">
                            <img src="{{ asset($doc['source']->path) }}" alt="{{ $doc['source']->description }}">
                        </div>
                        <div class="body">
                            <div class="title">{{ $doc['description'] }}</div>
                            <div class="date">{{ date('l, d M Y', strtotime($doc['created_at'])) }}</div>
                        </div>
                    </a>
                @endforeach

            </div>
            @endforeach
            <div class="more">
                <i class="fa fa-plus-circle fa-fw"></i> Show More.
            </div>
        </div>
    </section>

@endsection

@section('d_script')
    <script src="{{ asset('js/page.js') }}"></script>
    <script src="{{ asset('plugins/Venobox/venobox.min.js') }}"></script>
    <script>
        document.querySelector('#navbar').classList.add('scroll')
    </script>
@endsection