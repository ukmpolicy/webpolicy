@extends('guest.layouts.main')
@section('header')
@php
    $title = 'INTRODUCTION';
    $content = 'Unit Kegiatan Mahasiswa <b>Polytechnic Linux Community</b> (UKM POLICY) merupakan suatu UKM yang berada di bawah naungan Politeknik Negeri Lhokseumawe yang bergerak di bidang Teknologi Komputer terkhusnya terkait dengan Linux dan juga Open Source.';
    $image = asset('images/poltek.jpg');
    $url = url('introduction');
@endphp
@include('guest.includes.custom_header')
@endsection
@section('content')
<div id="introduction">
    <header>
        <div class="image">
            <img src="{{ asset('images/poltek.jpg') }}" alt="Foto depan Politeknik Negeri Lhokseumawe">
        </div>
        <div class="text">
            <h1>INTRODUCTION</h1>
            <p>Mari Mengenal UKM-POLICY Lebih Jauh</p>
        </div>
    </header>
    <div class="container py-5">

        <section class="about">
            <h2>APA ITU UKM-POLICY</h2>
            <p>Unit Kegiatan Mahasiswa <b>Polytechnic Linux Community</b> (UKM POLICY) merupakan suatu UKM yang berada di bawah naungan Politeknik Negeri Lhokseumawe yang bergerak di bidang Teknologi Komputer terkhusnya terkait dengan Linux dan juga Open Source.</p>
        </section>
        
        <section>
            <h2>SEJARAH UKM-POLICY</h2>
            <div class="row">
                {{-- <div class="col-lg-6"></div> --}}
                <div class="col-lg-12">
                    <p>Pembentukan komunitas ataupun organisasi Linux di politeknik negeri lhokseumawe sebenarnya sudah direncanakan mulai akhir tahun 2006 oleh angkatan pertama Teknik Infomatika yang mana kala itu belajar linux dan aplikasi open source masih sendiri-sendiri. Namun pembentukan ini terkendala karena  kala itu Teknik Informatika masih baru. Dan belum banyak teman-teman yang menyukai Linux. Jadi kala itu belajar linux masing sendiri-sendiri dan kadang-kadang masih dalam bentuk kelompok kecil  berbekal tutorial dari internet.</p>
                    <p>Seiring berjalannya waktu, Linux makin diminati oleh Mahasiswa dan dosen Politeknik Negeri Lhokseumawe. Munawir, salah satu angkatan Pertama Teknik Informatika Politeknik Negeri Lhokseumawe berinisatif membentuk salah satu wadah atau komunitas open source di kampus politeknik. Di Awali dengan rapat kecil Saudara Munawir bersama teman-teman yang tertarik dan  mempunyai keahlian di bidang Linux seperti Saudara Muhammad Rizka, Fachri, Bagus, Irhas, Zulfahmi, dan Mahendar Dwipayana yang semuanya itu dari angkatan pertama Teknik Informatika(2006),  akhirnya menyepakati  untuk menbentuk suatu komunitas Linux yang tidak hanya terdiri dari kalangan Teknik Informatika akan tetapi melingkup seluruh Keluarga Besar Politeknik Negeri Lhokseumawe dan . pada akhirnya keesokan harinya 13 November 2008 dibuatlah Rapat Umum dengan Agenda Pembentukan Komunitas, pemberian nama dan Pemilihan Ketua dengan mengundang seluruh mahasiswa Politeknik Negeri Lhokseumawe yang ingin bergabung dengan komunitas Linux. Dan Alhamdulillah Rapat perdana yang bertujuan untuk membentuk, memberi  nama komunitas  dan pemilihan ketua mendapat sambutan yang luar biasa dari rekan-rakan mahasiswa. Adapun yang menghadiri Rapat pada saat itu sekitar 60 Orang peserta yang didominasi dari mahasiswa Diploma IV Teknik Informatika, DIII Teknik Komputer dan Jaringan dan juga beberapa orang dari Teknik Telkom, Mesin dan Teknik sipil.
                    </p>
                    <p>Dalam Rapat tersebut terdapat poin-poin penting yang dihasilkan yaitu:</p>
                    <ul>
                        <li>
                            <p>Peserta rapat setuju dengan pembentukan komunitas Linux di Politeknik Negeri Lhokseumawe dengan harapan bisa dijadikan sebagai wadah sharing ilmu pengetahuan khususnya di bidang Linux / Open source.</p>
                        </li>
                        <li>
                            <p>Dari beberapa nama yang diajukan oleh peserta akhirnya disepakati nama “POLICY(Polytechnic Linux Community)” sebagai nama resmi Organisasi.</p>
                        </li>
                    </ul>
                    <p>Hingga pada akhirnya, terciptalah Sebuah Unit Kegiatan Mahasiswa Politechnic Linux Community (UKM-POLICY) yang telah di Resmikan di Kampus Politeknik Negeri Lhokseumawe. Sehingga sekarang dikenal sebagai UKM-POLICY .</p>
                </div>
            </div>
        </section>
        
        <section class="detail-logo">
            <h2>MAKNA LOGO UKM-POLICY</h2>
            <div class="row">
                <div class="col-lg-6 text-center py-5">
                    <img src="{{ asset('images/policy2.png') }}" alt="Logo Policy">
                </div>
                <div class="col-lg-6">
                    <ul>
                        <li>
                            <p>Gambar Pingguin menandakan mascot dari pada Linux.</p>
                        </li>
                        <li>
                            <p>Kata POLICY merupakan singkatan dari Polytechnic Linux Community yang bertempat di kampus Politeknik Negeri Lhokseumawe.</p>
                        </li>
                        <li>
                            <p>Pistol pada kata POLICY menggambarkan keamanan dengan menggunakan Linux lebih terjamin.</p>
                        </li>
                        <li>
                            <p>Lencana berwarna hitam melambangkan perwujudan dari bakat yang telah lama terpendam bagi seluruh anggota UKM-POLICY serta melambang persatuan dan kesatuan dari seluruh anggota.</p>
                        </li>
                        <li>
                            <p>Lambang target berwarna merah menunjukkan bahwa Linux dan Open Source adalah sasaran utama dari organisasi ini.</p>
                        </li>
                        <li>
                            <p>Kata Lhokseumawe menandakan bahwa UKM-POLICY ini bertempat di Kota Lhokseumawe.</p>
                        </li>
                    </ul>
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