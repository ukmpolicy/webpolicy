@extends('guest.layouts.main')
@section('header')
@php
    $title = 'OPEN RECRUITMENT';
    $content = 'Hari yang di tunggu-tunggu telah tiba. Acara perekrutan Anggota baru Unit Kegiatan Mahasiswa Polytechnic Linux Community (UKM-POLICY) resmi dibuka. Daftarkan diri kalian sekarang, mari temukan pengalaman baru bersama kami.';
    $image = asset('images/gallery/or.jpeg');
    $url = url('open-recruitment');
    
@endphp
@include('guest.includes.custom_header')
@endsection
@section('content')
<div id="open-recruitment">
    <header>
        <div class="image">
            <img src="{{ asset('images/gallery/or.jpeg') }}" alt="Foto Bersama Open Recruitment 2020">
        </div>
        <div class="text">
            <h1>OPEN RECRUITMENT</h1>
            <p>Mari Bergabung Dengan UKM-POLICY</p>
        </div>
    </header>
    <main class="content">
        <div class="container">
            @if ( $isOpen )
            <h2 class="">Halo Para Cyber Baru!</h2>
            <p>Hari yang di tunggu-tunggu telah tiba. Acara perekrutan Anggota baru Unit Kegiatan Mahasiswa Polytechnic Linux Community (UKM-POLICY) resmi dibuka. Daftarkan diri kalian sekarang, mari temukan pengalaman baru bersama kami. Sampai bertemu di acara `` TEMU RAMAH UKM-POLICY ``.</p>
            <div class="text-center media">
                <video controls src="{{ asset('videos/promosi.mp4') }}"></video>
                <div class="desc">Video Promosi UKM-POLICY 2022.</div>
            </div>
            <h2 class="mt-3">Syarat Dan Ketentuan Pendaftaran</h2>
            <ol>
                <li>
                    <p>Mahasiswa/i aktif Politeknik Negeri Lhokseumawe, bukan tingkat akhir.</p>
                </li>
                <li>
                    <p>Terbukti lulus PKKMB Politeknik Negeri Lhokseumawe.</p>
                </li>
                <li>
                    <p>Mengikuti Instagram UKM-POLICY yaitu @@ukmpolicy.kmbpnl</p>
                </li>
                <li>
                    <p>Mengunduh dan mengupload video promosi UKM-POLICY 2022 ke IGStory dengan menyertakan tag Instagram UKM-POLICY di Instagram masing-masing.</p>
                </li>
            </ol>
            <h2 class="mt-3">Langkah Pendaftaran</h2>
            <ol>
                <li>
                    <p>Registrasi akun policy anda <a href="{{ route('register') }}">disini</a>.</p>
                </li>
                <li>
                    <p>Silahkan mengunduh kuisioner <a href="{{ asset('kuisioner.pdf') }}" target="_blank" rel="noopener noreferrer">disini</a>.</p>
                </li>
                <li>
                    <p>Cetak kuisioner tersebut dan menjawab pertanyaan dengan tulis tangan.</p>
                </li>
                <li>
                    <p>Persiapkan pas foto 3x4 layar merah, bukti kelulusan pkkmb, dan bukti follow instagram UKM-POLICY.</p>
                </li>
                <li>
                    <p>Mengisi formulir dan mengunggah berkas yang telah dipersiapkan.</p>
                </li>
                <li>
                    <p>Pastikan data sudah terisi semua dan benar, tekan tombol 'Simpan'.</p>
                </li>
                <li>
                    <p>Setelah tersimpan, tekan tombol 'Cetak' untuk mencetak dan mengunduh Bukti Pendaftaran.</p>
                </li>
                <li>
                    <p>Menyerahkan Bukti Pendaftaran dan Uang Administrasi sebanyak Rp 10.000 di Sekretariat UKM-POLICY di Lantai 3 Gedung Utama Sayap Kiri.</p>
                </li>
                <li>
                    <p>Bukti Pendaftaran yang sudah dilegalisir dan kuisioner dibawa kembali saat wawancara.</p>
                </li>
            </ol>
            <div class="py-2 text-center px-3 rounded" style="background-color: #151515">
                @if (Auth::check())
                <p class="mt-2 text-capitalize">Ayo mari bergabung bersama kami!</p>
                <a href="{{ route('open-recruitment.form') }}" class="btn text-white d-block d-lg-inline-block btn-danger mb-2">ISI FORMULIR SEKARANG</a>
                @else
                <p class="mt-2 text-capitalize">Anda harus mempunyai akun policy dulu untuk mendaftar sebagai anggota policy!</p>
                <p class="mt-2 text-capitalize">Silahkan kembali ke halaman ini.</p>
                <a href="{{ route('open-recruitment.register') }}" class="btn text-white d-block d-lg-inline-block btn-danger mb-2">REGISTER SEKARANG</a>
                @endif
            </div>
            @else
            <div class="py-2 text-center px-3 rounded" style="background-color: #151515">
                <p class="mt-2 text-capitalize">Maaf pendaftaran ditutup untuk saat ini!</p>
                <a href="{{ route('main.home') }}" class="btn text-white d-block d-lg-inline-block btn-danger mb-2">KEMBALI KE BERANDA</a>
            </div>
            @endif
        </div>
    </main>
</div>
@endsection

@section('d_script')
    <script src="{{ asset('js/page.js') }}"></script>
    <script>
        document.querySelector('#navbar').classList.add('scroll')
    </script>
@endsection