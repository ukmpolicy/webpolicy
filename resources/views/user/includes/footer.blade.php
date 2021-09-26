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
                            <div class="item"><a href="{{route('main.home')}}#header"><i
                                        class="fa fa-angle-double-right"></i>Home</a></div>
                            <div class="item"><a href="{{route('main.home')}}#aboutUs"><i class="fa fa-angle-double-right"></i>About
                                    Us</a></div>
                            <div class="item"><a href="{{route('main.home')}}#visi"><i
                                        class="fa fa-angle-double-right"></i>Vision</a></div>
                            <div class="item"><a href="{{route('main.home')}}#misi"><i
                                        class="fa fa-angle-double-right"></i>Mission</a></div>
                            <div class="item"><a href="{{route('main.home')}}#structural"><i
                                        class="fa fa-angle-double-right"></i>Structural</a></div>
                            <div class="item"><a href="{{route('main.home')}}#contactUs"><i
                                        class="fa fa-angle-double-right"></i>Contact Us</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="head">
                        <h2>Pages:</h2>
                        <div class="items">
                            <div class="item"><a href=""><i
                                        class="fa fa-angle-double-right"></i>Articles</a></div>
                            <div class="item"><a href=""><i class="fa fa-angle-double-right"></i>Events</a>
                            </div>
                            <div class="item"><a href=""><i
                                        class="fa fa-angle-double-right"></i>Documentation</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="credits">
            <div class="container">
                <div class="copy">Copyright &copy; Polytechnic Linux Community  {{ date('Y') }}.</div>
                <div class="socmeds">
                    <a href="" class="item">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="item">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="" class="item">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
