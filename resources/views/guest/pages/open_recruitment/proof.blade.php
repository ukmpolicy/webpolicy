<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pendaftaran</title>
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/proof.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/proof.css') }}">
        
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo">
                <img src="{{ asset('images/pnl.png') }}" alt="">
            </div>
            <div class="text">
                <div>Bukti Pembayaran</div>
                <div>Unit Kegiatan Mahasiswa Polytechnic Linux Community</div>
                <div>POLITEKNIK NEGERI LHOKSEUMAWE</div>
                <p>Sekretariat: Jalan B-Aceh-Medan Km. 280,3 Buketrata, Lhokseumawe, 24301 P.O. Box 90 Email: <a href="#">policy.lhokseumawe@gmail.com</a></p>
            </div>
            <div class="logo">
                <img src="{{ asset('images/policy.png') }}" alt="" style="padding: 0 .5rem">
            </div>
        </header>
        
        <main>
            <div class="meta">
                <table class="table table-bordered small">
                    <tr>
                        <td rowspan="7" style="width: 4cm">
                            <img class="photo" src="{{ asset('uploads/'.$data['pas_foto']) }}">
                        </td>
                        <td>Nama</td>
                        <td class="text-capitalize">{{ $data['nama'] }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td class="text-capitalize">{{ $data['nim'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="text-capitalize">{{ $data['alamat'] }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone / Whatsapp</td>
                        <td class="text-capitalize">{{ $data['no_wa'] }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-capitalize">{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan / Program Studi</td>
                        <td class="text-capitalize">{{ $data['jurusan'] }} / {{ $data['prodi'] }}</td>
                    </tr>
                </table>
                <div class="text-black-50">* Bukti pembayaran dibawa kembali pada hari wawancara.</div>
                <div class="d-ttd">
                    <div class="ttd">
                        <div class="content">
                            <div>Panitia Pelaksana Open Recruitment,</div>
                            <div>Penerima,</div>
                            <br>
                            <br>
                            <br>
                            <u class="text-capitalize">(__________________________)</u>
                            <div>NIM. </div>
                        </div>
                    </div>
                    <div class="ttd ttd-right">
                        <div class="content">
                            <div>Buketrata, {{ $date }}</div>
                            <div>Peserta,</div>
                            <br>
                            <br>
                            <br>
                            <u class="text-capitalize">{{ $data['nama'] }}</u>
                            <div>NIM. {{ $data['nim'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>