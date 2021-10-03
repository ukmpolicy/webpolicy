    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12" id="contactUs">
                    <div class="head">
                        <h2>Contact Us:</h2>
                    </div>
                    <input type="text" class="inp" placeholder="Name">
                    <input type="email" class="inp" placeholder="Email">
                    <textarea class="inp" placeholder="Content"></textarea>
                    <button>Send</button>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="head">
                        <h2>Navigations:</h2>
                        <div class="items">
                            <div class="item"><a href="{{route('main.home')}}#header"><i class="fa fa-angle-double-right"></i>Beranda</a></div>
                            <div class="item"><a href="{{route('main.home')}}#aboutUs"><i class="fa fa-angle-double-right"></i>About Us</a></div>
                            <div class="item"><a href="{{route('main.home')}}#visi"><i class="fa fa-angle-double-right"></i>Visi</a></div>
                            <div class="item"><a href="{{route('main.home')}}#misi"><i class="fa fa-angle-double-right"></i>Misi</a></div>
                            <div class="item"><a href="{{route('main.home')}}#structural"><i class="fa fa-angle-double-right"></i>Struktural</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="head">
                        <h2>Pages:</h2>
                        <div class="items">
                            <div class="item"><a href="{{ route('main.articles') }}"><i class="fa fa-angle-double-right"></i>Articles</a></div>
                            <div class="item"><a href="{{ route('main.documentations') }}"><i class="fa fa-angle-double-right"></i>Dokumentasi</a>
                            </div>
                        </div>
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
