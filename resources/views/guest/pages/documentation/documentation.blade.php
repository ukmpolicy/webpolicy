@extends('guest.layouts.main')
@section('header')
@include('guest.includes.main_header')
@endsection
@section('content')
    <section id="documentation">
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
                @php
                    $docs = $documentations->getDocumentation($event->id)
                    @endphp
                @foreach ($docs as $doc)
                <div class="item">
                
                @if ($doc->type == 0)
                
                    <img src="{{ asset($doc->path) }}" alt="{{ $doc->description }}">
                
                @elseif ($doc->type == 1)

                    <iframe height="150" src="{{ $doc->path }}">

                @endif

                </div>
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