@extends('user.layout')
@section('header')
@php
    $title = strtoupper($division->name);
    $content = 'Unit Kegiatan Mahasiswa <b>Polytechnic Linux Community</b> (UKM POLICY) merupakan suatu UKM yang berada di bawah naungan Politeknik Negeri Lhokseumawe yang bergerak di bidang Teknologi Komputer terkhusnya terkait dengan Linux dan juga Open Source.';
    $image = asset('images/poltek.jpg');
    $url = url($division->name);
@endphp
@include('user.includes.custom_header')
@endsection
@section('content')
<div id="introduction">
    <header>
        <div class="image">
            <img src="{{ asset('images/poltek.jpg') }}" alt="Foto depan Politeknik Negeri Lhokseumawe">
        </div>
        <div class="text">
            <h1 class="text-uppercase">{{ $division->name }}</h1>
            <p>Struktural Dan Program Kerja</p>
        </div>
    </header>
    <div class="container py-5">

        <section class="text-center" id="structural">
            <div class="head">
                <h3>STRUKTURAL</h3>
                <div class="devider">
                    <div class="inner"></div>
                </div>
            </div>
            <div class="items">
                @foreach ($officers as $officer)
                    <div class="item">
                        <div class="image">
                            {{-- {{ dd($officer)}} --}}
                            @if (!is_null($officer->profile_image))
                            <img src="{{ asset('uploads/library/'.$officer->profile_image) }}" alt="{{ $officer->name }}">
                            @endif
                            {{-- {{ dd(is_null($officer['member']['profile_picture'])) }} --}}
                        </div>
                        <div class="body">
                            <div class="name text-capitalize mt-3">{{ $officer->name }}</div>
                            <div class="role small mt-0 text-white-50 text-capitalize" style="font-weight:normal;">{{ $roles[$officer->role].' '.$officer->division }}</div>
                        </div>
                    </div>
                    @if ($loop->iteration%3==0 && $loop->iteration < count($officers))
                    <div class="devider d-none d-lg-block">
                        <div class="inner"></div>
                    </div>
                    @endif
                @endforeach
            </div>
        </section>
       
        <section id="programs">
            <div class="head">
                <h3>PROGRAM KERJA</h3>
                <div class="devider">
                    <div class="inner"></div>
                </div>
            </div>
            <div class="row">
                @foreach ($programs as $program)
                <section class="col-12 col-lg-6">
                    <h2>{{ $program->name }}</h2>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{ $program->description }}</p>
                            <div class="small mt-2 text-white-50">Jadwal: {{ date('l, d F Y', strtotime($program->start_at)) }}</div>
                        </div>
                    </div>
                </section>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection

@section('d_script')
    <script src="{{ asset('js/page.js') }}"></script>
    <script>
        document.querySelector('#navbar').classList.add('scroll')
    </script>
@endsection