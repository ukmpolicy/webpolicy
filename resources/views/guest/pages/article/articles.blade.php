@extends('guest.layouts.main')
@section('header')
@include('guest.includes.main_header')
@endsection
@section('content')
    <section id="articles">
        <div class="container">
            <div class="head">
                <h2>ARTICLES</h2>
                <div class="devider"></div>
            </div>
            {{-- <h4 class="mb-3">~ Artikel terbaru</h4> --}}
            <div class="items">
                @foreach ($articles as $article)
                    <a href="{{ route('main.article', ['slug' => $article['slug']]) }}" class="item">
                        <div class="image">
                            <img src="{{ asset('uploads/'.$article['thumbnail']) }}" alt="thumbnail">
                        </div>
                        <div class="body">
                            <div class="title text-capitalize">{{ $article['title'] }}</div>
                            <div class="meta mt-2">
                                <div class="text-capitalize">
                                    {{-- <span class="small">#{{ $article['creator']['username'] }}</span> --}}
                                    <span class="small">#{{ $article['category']['name'] }}</span>
                                </div>
                                <div class="date" style="opacity: .5">{{ date('l, d M Y', strtotime($article['created_at'])) }}</div>
                            </div>
                        </div>
                    </a>  
                @endforeach
            </div>
            @if ((int) Request::get('max') < $count)
            <a href="{{ route('main.articles').'?max='.((Request::get('max')) ? Request::get('max') + 4 : 12)  }}" class="more d-block" style="text-decoration: none">
                <i class="fa fa-plus-circle fa-fw"></i> Perbanyak
            </a>
            @endif
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