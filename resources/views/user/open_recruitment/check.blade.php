@extends('user.layout')

@section('content')
<style>
    img {
        width: 100%
    }
    .pp {
        width: 8cm;
        height: 9.5cm;
        object-fit: cover;
    }
</style>
    <section id="articles">
        <div class="container text-center">
            <h2 class="text-uppercase">{{ $name }}</h2>
            <img class="pp my-2" src="{{ asset($profile_picture) }}" alt="">
            <table class="table text-start text-capitalize table-striped table-dark" style="font-family: Calibri">
                <tr>
                    <td>Nama</td>
                    <td>{{ $name }}</td>
                </tr>
                <tr>
                    <td>Nim</td>
                    <td>{{ $nim }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $address }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ $born_at }}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td>{{ $birth_place }}</td>
                </tr>
                <tr>
                    <td>Nomor Handphone / Whatsapp</td>
                    <td>{{ $phone_number }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $email }}</td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>{{ $major }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>{{ $study_program }}</td>
                </tr>
                <tr>
                    <td>Pilihan Bidang Minat</td>
                    <td>{{ $interested_in }}</td>
                </tr>
            </table>
            <img class="my-3" src="{{ asset($proof_pkkmb) }}" alt="">
            <img src="{{ asset($certificate) }}" alt="">
        </div>
    </section>
@endsection

@section('d_script')
    <script src="{{ asset('js/page.js') }}"></script>
    <script>
        document.querySelector('#navbar').classList.add('scroll')
    </script>
@endsection