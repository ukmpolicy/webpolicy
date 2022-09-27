@extends('guest.layouts.main')
@section('d_style') 
{{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}"> --}}
<style>
    #libraryLayout .card .library-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #libraryLayout .card .library-header .card-title {
        font-weight: normal !important;
        font-family: Arial;
        margin: 0;
        font-size: 18px !important;
    }
    #libraryLayout .search {
        display: none;
    }
    .choice-file {
        margin: .5rem 0;
        height: 100px;
        background-color: #313131;
        border-radius: 6px;
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        padding: .5rem;
        flex-direction: column;
        cursor: pointer;
    }
    .choice-file:hover {
        background-color: #2a2a2a;
    }
    .choice-file .title {
        font-size: 13px;
        color: #fff;
        text-transform: uppercase;
        font-family: Calibri;
        opacity: .8;
    }
    .choice-file .subtitle {
        font-size: 11px;
        color: #fff;
        font-family: Calibri;
        opacity: .4;
    }
    .choice-file .normal{
        display: block;
    }
    .choice-file .success{
        display: none;
    }
    .choice-file.success .normal{
        display: none;
    }
    .choice-file.success .success{
        display: block;
    }
    .choice-file span {
        font-size: 11px;
        font-family: Calibri;
        color: red;
        margin-right: .2rem;
    }
    .btn-send {
        width: 100%;
        padding: .8rem 1.2rem;
        margin-top: 1rem;
        background: rgb(184, 33, 33);
        border: 0;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .3);
        color: #fff !important;
    }
    .btn-send:hover {
        background: rgb(148, 24, 24);
    }
    .btn-send:active,.btn-send:focus {
        /* background: rgb(148, 24, 24); */
        box-shadow: none !important;
    }
</style>

@endsection
@section('content')
    <div id="recruitment">
        <div class="container py-5">
            
            <div class="head">
                <h2>FORMULIR PENDAFTARAN</h2>
                <div class="devider"></div>
            </div>
            @if (session('success'))
            <div class="alert alert-sm alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('open-recruitment.save') }}" id="form" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
        
                    <div class="col-md-6">
        
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">

                                {{-- Nim --}}
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="number" value="{{ (strlen(old('nim')) > 0) ? old('nim') : $data['nim'] }}" class="form-control" id="nim" name="nim">
                                    @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                {{-- Nama --}}
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" value="{{ (strlen(old('nama')) > 0) ? old('nama') : $data['nama'] }}" class="form-control" id="nama" name="nama">
                                    @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" value="{{ (strlen(old('alamat')) > 0) ? old('alamat') : $data['alamat'] }}" class="form-control" id="alamat"
                                        name="alamat">
                                    @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                {{-- Tanggal Lahir --}}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                        </div>
                                        <div class="col-6" style="text-align: right">
                                            <div class="small" style="opacity: .5;">Format: Bulan / Tanggal / Tahun</div>
                                        </div>
                                    </div>
                                    <input type="date" value="{{ (strlen(old('tgl_lahir')) > 0) ? old('tgl_lahir') : $data['tgl_lahir'] }}" class="form-control" id="tgl_lahir"
                                        name="tgl_lahir">
                                    @error('tgl_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                {{-- Tempat Lahir --}}
                                <div class="form-group">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" value="{{ (strlen(old('tmp_lahir')) > 0) ? old('tmp_lahir') : $data['tmp_lahir'] }}" class="form-control" id="tmp_lahir"
                                        name="tmp_lahir">
                                    @error('tmp_lahir') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
        
                        <div class="card">
    
                            <!-- Nomor HP -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_wa">Nomor Whatsapp</label>
                                    <input type="number" value="{{ (strlen(old('no_wa')) > 0) ? old('no_wa') : $data['no_wa'] }}"class="form-control" id="no_wa" name="no_wa">
                                    @error('no_wa') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
    
                                {{-- Email --}}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ (strlen(old('email')) > 0) ? old('email') : $data['email'] }}" class="form-control" id="email"
                                        name="email">
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
        
        
                    <div class="col-md-6">
        
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">

                                {{-- Jurusan --}}
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select class="form-control rounded-0" value="{{ (strlen(old('jurusan')) > 0) ? old('jurusan') : $data['jurusan'] }}" id="jurusan"
                                        name="jurusan"></select>
                                    @error('jurusan') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                {{-- Program Studi --}}
                                <div class="form-group">
                                    <label for="prodi">Program Studi</label>
                                    <select class="form-control rounded-0" id="prodi" name="prodi">
                                    </select>
                                    @error('prodi') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                            </div>

                        </div>
                        
                        {{-- Upload Berkas --}}
                        <div class="card">
                            <!-- form start -->
                            <div class="card-header">
                                <div class="card-title mt-1">Upload Berkas</div>
                            </div>
                            <div class="card-body">
                                <div class="small text-danger">
                                    @error('pas_foto')*  {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('bkpkkmb')*  {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('bukti_follow')*  {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('bukti_pemabayaran')*  {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('kuisioner')*  {{ $message }} @enderror
                                </div>
                                <div class="row">

                                    {{-- Photo --}}
                                    <div class="col-lg-6">
                                        <div class="choice-file" id="pas_foto" onclick="choiceFile('pas_foto')">
                                            <input type="file" class="d-none file-selector" value="" name="pas_foto">
                                            <input type="hidden" name="pas_foto-value" class="file-value" value="{{ $data['pas_foto'] }}">
                                            <div class="body">
                                                <div class="normal">
                                                    <span>(WAJIB)</span>
                                                    <div class="title">Pas Foto 3x4</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <div class="success">
                                                    <div class="text-success"><i class="fa fa-check"></i></div>
                                                    <div class="title">Pas Foto 3x4</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Bukti Kelulusan PKKMB --}}
                                    <div class="col-lg-6">
                                        <div class="choice-file" id="bkpkkmb" onclick="choiceFile('bkpkkmb')">
                                            
                                            <input type="file" class="d-none file-selector" value="" name="bkpkkmb">
                                            <input type="hidden" name="bkpkkmb-value" class="file-value" value="{{ $data['bkpkkmb'] }}">
                                            <div class="body">
                                                <div class="normal">
                                                    <span>(WAJIB)</span>
                                                    <div class="title">Bukti Kelulusan PKKMB</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <div class="success">
                                                    <div class="text-success"><i class="fa fa-check"></i></div>
                                                    <div class="title">Bukti Kelulusan PKKMB</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Bukti Follow --}}
                                    <div class="col-lg-6">
                                        <div class="choice-file" id="bukti_follow" onclick="choiceFile('bukti_follow')">
                                            
                                            <input type="file" class="d-none file-selector" value="" name="bukti_follow">
                                            <input type="hidden" class="file-value" name="bukti_follow-value" value="{{ $data['bukti_follow'] }}">
                                            <div class="body">
                                                <div class="normal">
                                                    <span>(WAJIB)</span>
                                                    <div class="title">Bukti Follow Instagram</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <div class="success">
                                                    <div class="text-success"><i class="fa fa-check"></i></div>
                                                    <div class="title">Bukti Follow Instagram</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                          
                                    {{-- Bukti Pembayaran --}}
                                    <div class="col-lg-6">
                                        <div class="choice-file" id="kuisioner" onclick="choiceFile('kuisioner')">
                                            
                                            <input type="file" class="d-none file-selector" value="" name="kuisioner">
                                            <input type="hidden" name="kuisioner-value" class="file-value" value="{{ $data['kuisioner'] }}">
                                            <div class="body">
                                                <div class="normal">
                                                    <span>(OPTIONAL)</span>
                                                    <div class="title">Upload Kuisioner</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <div class="success">
                                                    <div class="text-success"><i class="fa fa-check"></i></div>
                                                    <div class="title">Upload Kusioner</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-send" name="simpan">Simpan</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-send" name="print">Cetak</button>
                            </div>
                        </div>
        
                    </div>
        
                </div>
            </form>
        </div>
    </div>
    
<div class="modal fade" id="sendData" tabindex="-1" aria-labelledby="sendDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Tolong Konfirmasi</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda sudah yakin telah mengisi data anda dengan benar? Jika anda mengirim maka tidak dapat melakukan perubahan kembali!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="sendData()">Ya, Saya Yakin</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('d_script')
<script>
    document.querySelector('#navbar').classList.add('scroll')

    let jurusan = {
        "Teknik Sipil": [
            "Teknologi Kontruksi Bangunan Air",
            "Teknologi Rekayasa Kontruksi Bangunan Gedung",
            "Teknologi Kontruksi Jalan dan Jembatan",
            "Teknologi Rekayasa Kontruksi Jalan dan Jembatan",
            "Jalur Cepat Pengukuran dan Penggambaran Tapak Bangunan Gedung",
        ],
        "Teknik Mesin": [
            "Teknologi Rekayasa Manufaktur",
            "Teknologi Mesin",
            "Teknologi Industri",
            "Teknologi Rekayasa Pengelasan dan Fabrikasi",
        ],
        "Teknik Kimia": [
            "Teknologi Kimia",
            "Teknologi Pengolahan Minyak dan Gas Bumi",
            "Teknologi Rekayasa Kimia Industri",
        ],
        "Teknik Elektro": [
            "Teknologi Listrik",
            "Teknologi Rekayasa Pembangkit Energi",
            "Teknologi Rekayasa Jaringan Telekomunikasi",
            "Teknologi Rekayasa Instrumentasi dan Kontrol",
            "Teknologi Telekomunikasi",
            "Teknologi Elektronika",
            "Teknologi Metronika",
        ],
        "Tata Niaga": [
            "Akuntansi",
            "Administrasi Bisnis",
            "Akuntansi Sektor Publik",
            "Akuntasi Lembaga Keuangan Syariah",
            "Manajemen Keuangan Sektor Publik",
        ],
        "Teknologi Informasi dan Komputer": [
            "Teknik Informatika",
            "Teknologi Rekayasa Komputer Jaringan",
            "Teknologi Rekayasa Multimedia",
        ],
    };

    let options = ``;
    for (const key in jurusan) {
        if (Object.hasOwnProperty.call(jurusan, key)) {
            options += `<option ${('{{(strlen(old("jurusan")) > 0) ? old('jurusan') : $data['jurusan']}}' == key) ? 'selected' : ''} value="${key}">${key}</option>`;
        }
    }

    $('#jurusan').html(options);
    updateProdi();

    $('#jurusan').change(() => {
        updateProdi();
    })

    // Fungsi untuk menampilkan prodi berdasarkan jurusan dalam bentuk tag option
    function updateProdi() {
        let options = ``;
        jurusan[$('#jurusan').val()].forEach(v => {
        options += `<option ${('{{(strlen(old("prodi")) > 0) ? old('prodi') : $data['prodi']}}' == v) ? 'selected' : ''} value="${v}">${v}</option>`;
        });
        $('#prodi').html(options);
    }

    function checkFileInputs() {
        let inps = document.querySelectorAll('.choice-file');
        inps.forEach(function(inp) {
            let id = $(inp).attr('id');
            let input = document.querySelector('#' + id + ' .file-value');
            
            // console.log(input.attributes.name)
            // console.log(document.forms['form'][input.attributes.name]);
            if (input.value.trim().length > 0) {
                document.querySelector('#' + id + ' .normal').style.display = 'none';
                document.querySelector('#' + id + ' .success').style.display = 'block';
            }else {
                document.querySelector('#' + id + ' .normal').style.display = 'block';
                document.querySelector('#' + id + ' .success').style.display = 'none';
            }
        })
    }

    checkFileInputs();
    
    function choiceFile(id) {
        document.querySelector('#'+ id +' .file-selector').onchange = function() {
            let id = $(this.parentNode).attr('id');
            console.log(id)
            document.querySelector('#' + id + ' .file-value').value = true;
            checkFileInputs();
        }
        document.querySelector('#' + id + ' .file-selector').click();
        // checkFileInputs();
    }

</script>
@endsection
