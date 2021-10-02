@extends('user.layout')

@section('content')
    <div id="header">
        <div class="owl-carousel">

            <div class="item">
                <div class="image">
                    <img src="{{ asset('images/gallery/DSC_0111.jpg') }}" alt="">
                </div>
                <div class="body">
                    <h2 class="title">Open Recruitment</h2>
                    <p class="subtitle">Saatnya Telah Tiba Untuk Bergabung Dalam UKM-POLICY Maka Mari Temukan Pengalaman Baru Bersama Kami</p>
                    <p class="subtitle"></p>
                    <div class="btn btn-ctf">DAFTARKAN  </div>
                </div>
            </div>
            
            <div class="item">
                <div class="image">
                    <img src="{{ asset('images/gallery/DSC_0111.jpg') }}" alt="">
                </div>
                <div class="body">
                    <h2 class="title">Open Recruitment</h2>
                    <p class="subtitle">Saatnya Telah Tiba Untuk Bergabung Dalam UKM-POLICY Maka Mari Temukan Pengalaman Baru Bersama Kami</p>
                    <p class="subtitle"></p>
                    <div class="btn btn-ctf">DAFTARKAN  </div>
                </div>
            </div>

        </div>
        <div id="nav-carousel">
            <div class="container">
                    <div class="prev">
                        <i class="fa fa-angle-left"></i>
                    </div>

                    <div class="next">
                        <i class="fa fa-angle-right"></i>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('aboutUs')
    <section id="aboutUs">
        <a href="#aboutUs" class="btn-started"><i class="fa fa-angle-left"></i></a>
        <div class="text-center text-white container main">
            <h3 class="text-danger">SELAMAT DATANG</h3>
            <h1>POLYTECHNIC LINUX COMMUNITY</h1>
            <p>Explore Linux And Open Source With Us. </p>
            <a href="{{ route('main.introduction') }}" class="introduction">MENGENAL LEBIH JAUH</a>
        </div>
    </section>
@endsection

@section('visi')
    <section id="visi" style="background-image: url('{{ asset('images/gallery/IMG_0072.JPG') }}')">
        {{-- <div class="wafe"></div> --}}
        <div class="main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="head">
                            <h2 class="wow fadeInUp">VISI</h2>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Mewujudkan Politeknik Negeri Lhokseumawe sebagai Cyber Campus dan Cyber Community.</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Memerdekakan dan membudayakan penggunaan ICT dengan GNU/Linux dan Open Source.</p>
                        </div>
                    </div>
                    <div class="col-lg-6  d-lg-block d-none">
                        <img src="{{ asset('images/illustrator/astronout.svg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('misi')
    <section id="misi" style="background-image: url('{{ asset('images/gallery/IMG_0061.JPG') }}')">
        <div class="main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-lg-block d-none" style="float: right;">
                        <img src="{{ asset('images/illustrator/rocket.svg') }}" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="head">
                            <h2>MISI</h2>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Memasyarakatkan GNU/Linux dan Open Source</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p> Mensosialisasikan Linux dan Open Source melalui event rutin.</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Berpartisipasi dan berperan aktif dalam mengembangkan jaringan kerjasama dengan lembaga Politeknik Negeri Lhokseumawe , komunitas Linux dan Open Source lainnya lainnya, Perguruan tinggi dan Pemerintah Daerah maupun Pusat.</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Mengembangkan dan Memanfaatkan aplikasi Open Source.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Structural')
    <section id="structural">
        <div class="container">
            <div class="head">
                <h2>STRUKTURAL</h2>
                <div class="devider">
                    <div class="inner"></div>
                </div>
            </div>
            <div class="items">
                @foreach ($officers as $officer)
                    <div class="item">
                        <div class="image">
                            @if (!is_null($officer['member']['profile_picture']))
                            <img src="{{ $officer['member']['profile_picture']['path'] }}" alt="">
                            @endif
                            {{-- {{ dd(is_null($officer['member']['profile_picture'])) }} --}}
                        </div>
                        <div class="body">
                            <div class="role text-capitalize">{{ $officer['role'].' '.$officer['devision'] }}</div>
                            <div class="name text-capitalize">{{ $officer['member']['name'] }}</div>
                        </div>
                    </div>
                    @if ($loop->iteration%3==0)
                    <div class="devider d-none d-lg-block">
                        <div class="inner"></div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('d_script')
    <script src="{{ asset('js/base.js') }}"></script>
@endsection