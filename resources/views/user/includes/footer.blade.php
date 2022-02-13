    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12" id="contactUs">
                    <div class="head">
                        <h2>Masukan:</h2>
                    </div>
                    <form action="{{ route('mail.store') }}" method="post">
                        @csrf
                        <input type="text" class="inp" placeholder="Name" name="name">
                        @error('name') <div class="text-danger" style="font-size: 12px">{{ $message }}</div> @enderror
                        <input type="email" class="inp" placeholder="Email" name="email">
                        @error('email') <div class="text-danger" style="font-size: 12px">{{ $message }}</div> @enderror
                        <textarea class="inp" placeholder="Content" name="content"></textarea>
                        @error('content') <div class="text-danger" style="font-size: 12px">{{ $message }}</div> @enderror
                        <button>Send</button>
                    </form>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="head">
                        <h2>Navigasi:</h2>
                    </div>
                    <div class="items">
                        <div class="item"><a href="{{route('main.home')}}#header"><i class="fa fa-angle-double-right"></i>Sorotan</a></div>
                        <div class="item"><a href="{{route('main.home')}}#visi"><i class="fa fa-angle-double-right"></i>Visi</a></div>
                        <div class="item"><a href="{{route('main.home')}}#misi"><i class="fa fa-angle-double-right"></i>Misi</a></div>
                        <div class="item"><a href="{{route('main.home')}}#structural"><i class="fa fa-angle-double-right"></i>Struktural</a></div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="head">
                        <h2>Halaman:</h2>
                    </div>
                    <div class="items">
                        <div class="item"><a href="{{ route('main.home') }}"><i class="fa fa-angle-double-right"></i>Beranda</a></div>
                        <div class="item"><a href="{{ route('main.articles') }}"><i class="fa fa-angle-double-right"></i>Artikel</a></div>
                        <div class="item"><a href="{{ route('main.documentations') }}"><i class="fa fa-angle-double-right"></i>Dokumentasi</a>
                        </div>
                        <div class="item"><a href="{{ route('main.documentations') }}"><i class="fa fa-angle-double-right"></i>Tentang Kami</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="head">
                        <h2>Bidang:</h2>
                    </div>
                    <div class="items">
                        @foreach (DB::table('divisions')->get() as $div)
                            <div class="item">
                                <a href="{{ route('main.division', ['division' => $div->name]) }}" class="text-capitalize"><i class="fa fa-angle-double-right"></i>{{ $div->name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="credits">
            <div class="container">
                <div class="copy">Copyright &copy;2021 Polytechnic Linux Community.</div>
                <div class="socmeds">
                    <a href="instagram.com/policy.kbmpnl" class="item">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="youtube.com/" class="item">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="facebook.com/" class="item">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
