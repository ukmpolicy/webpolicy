@extends('user.layout')

@section('content')
<div id="introduction">
    <header>
        <div class="image">
            <img src="{{ asset('images/head/document-2178656.jpg') }}" alt="">
        </div>
        <div class="text">
            <h1>INTRODUCTION</h1>
            <p>Mari Mengenal UKM-POLICY Lebih Jauh</p>
        </div>
    </header>
    <div class="container">

        <section class="about">
            <h2>APA ITU UKM-POLICY</h2>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, explicabo commodi, fugit odit laudantium veritatis velit, repellat obcaecati minus minima debitis officiis consectetur mollitia eum nemo. Sapiente ex quo temporibus quia eius unde sunt, nostrum nobis obcaecati explicabo deserunt eligendi, voluptate fugiat doloribus saepe possimus beatae dolor neque totam quis quidem! Perferendis sed fugiat labore minima omnis velit atque magnam necessitatibus veritatis accusamus deserunt non, ipsam excepturi explicabo aspernatur harum libero temporibus vero! Aliquid explicabo accusantium placeat? Error, doloribus aspernatur.</p>
                </div>
            </div>
        </section>
        
        <section class="story">
            <h2>SEJARAH UKM-POLICY</h2>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, explicabo commodi, fugit odit laudantium veritatis velit, repellat obcaecati minus minima debitis officiis consectetur mollitia eum nemo. Sapiente ex quo temporibus quia eius unde sunt, nostrum nobis obcaecati explicabo deserunt eligendi, voluptate fugiat doloribus saepe possimus beatae dolor neque totam quis quidem! Perferendis sed fugiat labore minima omnis velit atque magnam necessitatibus veritatis accusamus deserunt non, ipsam excepturi explicabo aspernatur harum libero temporibus vero! Aliquid explicabo accusantium placeat? Error, doloribus aspernatur.</p>
                </div>
            </div>
        </section>
        
        <section class="detail-logo">
            <h2>MAKNA LOGO UKM-POLICY</h2>
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ asset('images/policy.png') }}" alt="Logo Policy">
                </div>
                <div class="col-lg-6">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, explicabo commodi, fugit odit laudantium veritatis velit, repellat obcaecati minus minima debitis officiis consectetur mollitia eum nemo. Sapiente ex quo temporibus quia eius unde sunt, nostrum nobis obcaecati explicabo deserunt eligendi, voluptate fugiat doloribus saepe possimus beatae dolor neque totam quis quidem! Perferendis sed fugiat labore minima omnis velit atque magnam necessitatibus veritatis accusamus deserunt non, ipsam excepturi explicabo aspernatur harum libero temporibus vero! Aliquid explicabo accusantium placeat? Error, doloribus aspernatur.</p>
                </div>
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