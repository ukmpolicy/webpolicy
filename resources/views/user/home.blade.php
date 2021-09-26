@extends('user.layout')

@section('content')
    <div id="header">
        <div class="owl-carousel">

            <div class="item">
                <div class="image">
                    <img src="{{ asset('images/head/document-2178656.jpg') }}" alt="">
                </div>
                <div class="body">
                    <h2 class="title">Linux is Everythings</h2>
                    <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit totam provident
                        veritatis nostrum voluptas sit quidem numquam dolorem impedit blanditiis quisquam.</p>
                    <div class="btn btn-ctf">About Us</div>
                </div>
            </div>
            <div class="item">
                <div class="image">
                    <img src="{{ asset('images/head/knowledge-1052014.jpg') }}" alt="">
                </div>
                <div class="body">
                    <h2 class="title">Festival Linux Indonesia</h2>
                    <p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum veritatis, fugit
                        aperiam esse cum necessitatibus?</p>
                    <div class="btn btn-ctf">See Events</div>
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
        <div class="head" data-wow-delay="5s">
            <h2 class="wow fadeInUp">About Us</h2>
            <div class="devider"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image">
                        <img src="{{ asset('images/head/document-2178656.jpg') }}" alt="image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main">
                        <h1>Polytechnic Linux Comunity</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet velit doloremque quibusdam
                            praesentium reprehenderit eaque omnis, minima maiores ipsam nesciunt, libero, excepturi
                            molestiae est quod cum dolorem dolorum quisquam veritatis ducimus! Iusto facere vero nulla
                            culpa quaerat tenetur minus, corporis id. Dolorum beatae quos quasi autem odio possimus iure
                            ipsa facilis doloribus! Distinctio tempora repellat ipsum totam autem, est, sapiente
                            obcaecati inventore qui doloremque voluptates exercitationem hic ducimus enim sit.</p>
                        <!-- <a href="storyline.html" class="storyLine">Story Line Policy</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('visi')
    <section id="visi">
        <div class="wafe"></div>
        <div class="main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="head">
                            <h2 class="wow fadeInUp">VISION</h2>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur commodi quaerat alias.
                            </p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Eius rerum omnis debitis odit harum dignissimos placeat, in voluptatibus modi,
                                perspiciatis nihil molestias iusto mollitia ad distinctio!</p>
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
    <section id="misi">
        <div class="main">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-lg-block d-none" style="float: right;">
                        <img src="{{ asset('images/illustrator/rocket.svg') }}" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="head">
                            <h2>MISSION</h2>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur commodi quaerat alias.
                            </p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Eius rerum omnis debitis odit harum dignissimos placeat, in voluptatibus modi,
                                perspiciatis nihil molestias iusto mollitia ad distinctio!</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Eius rerum omnis debitis odit harum dignissimos placeat, in voluptatibus modi,
                                perspiciatis nihil molestias iusto mollitia ad distinctio!</p>
                        </div>
                        <div class="item">
                            <div class="dot"></div>
                            <p>Eius rerum omnis debitis odit harum dignissimos placeat, in voluptatibus modi,
                                perspiciatis nihil molestias iusto mollitia ad distinctio!</p>
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
                <h2>Structural</h2>
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