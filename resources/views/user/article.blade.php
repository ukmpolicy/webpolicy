@extends('user.layout')
@section('content')
<div id="article">
    <div class="image">
        <img src="{{ asset($thumbnail->path) }}" alt="{{ $thumbnail->description }}">
    </div>
        <div class="container">
            <div class="head">
                <h1 class="title">{{ $title }}</h1>
                <div class="meta">
                    <div class="date">{{ $created_at }}</div>
                    <div class="date">#{{ $creator->username }} #{{ $category->name }}</div>
                </div>
            </div>
            <div class="content">
                {!! $content !!}
            </div>
        </div>
    </div>
@endsection
@section('d_script')
<script src="{{ asset('plugins/Venobox/venobox.min.js') }}"></script>
<script src="{{ asset('js/page.js') }}"></script>
<script>
    document.querySelector('#navbar').classList.add('scroll')
</script>
@endsection