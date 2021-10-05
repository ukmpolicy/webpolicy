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
    <div class="wrapper w-footer">
        <header>
            <div class="logo">
                <img src="{{ asset('images/pnl.png') }}" alt="">
            </div>
            <div class="text">
                <div>Bukti Pendaftaran Anggota Baru</div>
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
                <table class="mb-3">
                    <tr>
                        <td style="width:100px">Nama</td>
                        <td class="text-capitalize">: {{ $name }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td class="text-capitalize">: {{ $nim }}</td>
                    </tr>
                </table>
                <table class="table table-bordered small">
                    <tr>
                        <td rowspan="6" style="width: 4cm">
                            <img class="photo" src="{{ asset($profile_picture) }}">
                        </td>
                        <td>Alamat</td>
                        <td class="text-capitalize">{{ $address }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone / Whatsapp</td>
                        <td class="text-capitalize">{{ $phone_number }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-capitalize">{{ $email }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td class="text-capitalize">{{ $major }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td class="text-capitalize">{{ $study_program }}</td>
                    </tr>
                    <tr>
                        <td>Pilihan Bidang Minat</td>
                        <td class="text-capitalize">{{ $interested_in }}</td>
                    </tr>
                </table>
                <div class="text-black-50">* Bukti pendaftaran ini diserahkan di Sekretariat UKM-POLICY beserta kuisioner dan uang administrasi.</div>
                <div class="ttd ttd-right">
                    <div class="content">
                        <div>Bukitrata, {{ date('d') }} Oktober 2021</div>
                        <div>Peserta,</div>
                        <br>
                        <br>
                        <br>
                        <u class="text-capitalize">{{ $name }}</u>
                        <div>NIM. {{ $nim }}</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="wrapper" style="margin-top: 1rem">
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
                <table class="mb-3">
                    <tr>
                        <td style="width:100px">Nama</td>
                        <td class="text-capitalize">: {{ $name }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td class="text-capitalize">: {{ $nim }}</td>
                    </tr>
                </table>
                <table class="table table-bordered small">
                    <tr>
                        <td rowspan="6" style="width: 4cm">
                            <img class="photo" src="{{ asset($profile_picture) }}">
                        </td>
                        <td>Alamat</td>
                        <td class="text-capitalize">{{ $address }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Handphone / Whatsapp</td>
                        <td class="text-capitalize">{{ $phone_number }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-capitalize">{{ $email }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td class="text-capitalize">{{ $major }}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td class="text-capitalize">{{ $study_program }}</td>
                    </tr>
                    <tr>
                        <td>Pilihan Bidang Minat</td>
                        <td class="text-capitalize">{{ $interested_in }}</td>
                    </tr>
                </table>
                <div class="text-black-50">* Bukti pembayaran dibawa pada saat hari wawancara.</div>
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
                            <div>Bukitrata, {{ date('d') }} Oktober 2021</div>
                            <div>Peserta,</div>
                            <br>
                            <br>
                            <br>
                            <u class="text-capitalize">{{ $name }}</u>
                            <div>NIM. {{ $nim }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        // window.print();
        // setTimeout(function() {
        //     location.replace('/');
        // }, 5000);
    </script>
</body>
</html>