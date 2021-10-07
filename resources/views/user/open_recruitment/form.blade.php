@extends('user.layout')
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
            <form action="{{ route('open-recruitment.store') }}" id="form" method="post">
                @csrf
                <div class="row">
        
                    <div class="col-md-6">
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-header">
                                <div class="card-title mt-1">Upload Berkas</div>
                            </div>
                            <div class="card-body">
                                <div class="small text-danger">
                                    @error('photo_input') {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('proof_pkkmb') {{ $message }} @enderror
                                </div>
                                <div class="small text-danger">
                                    @error('certificate') {{ $message }} @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="choice-file" id="photo" onclick="library.open('#photo_input',{parent: '#photo', name: 'photo'}, 'image|max:5000')">
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
                                            <input type="hidden" name="photo" id="photo_input" class="d-none">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="choice-file" id="proof_pkkmb" onclick="library.open('#ppkkmb_input',{parent: '#proof_pkkmb', name: 'proof_pkkmb'}, 'image|max:50000')">
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
                                                <input type="hidden" name="proof_pkkmb" id="ppkkmb_input" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="choice-file" id="certificate" onclick="library.open('#certificate_input',{parent: '#certificate', name: 'certificate'}, 'image|max:50000')">
                                            <div class="body">
                                                <div class="normal">
                                                    <div class="title">Sertifikat</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <div class="success">
                                                    <div class="text-success"><i class="fa fa-check"></i></div>
                                                    <div class="title">Sertifikat</div>
                                                    <div class="subtitle">Tap To Choice</div>
                                                </div>
                                                <input type="hidden" name="certificate" id="certificate_input" class="d-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="number" value="{{ old('nim') }}" class="form-control" id="nim" name="nim">
                                    @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name">
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" value="{{ old('address') }}" class="form-control" id="address"
                                        name="address">
                                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="born_at">Tanggal Lahir</label>
                                    <input type="date" value="{{ old('born_at') }}" class="form-control" id="born_at"
                                        name="born_at">
                                    @error('born_at') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="birth_place">Tempat Lahir</label>
                                    <input type="text" value="{{ old('birth_place') }}" class="form-control" id="birth_place"
                                        name="birth_place">
                                    @error('birth_place') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
        
                    </div>
        
        
                    <div class="col-md-6">
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="phone_number">Nomor Handphone</label>
                                    <input type="number" value="{{ old('phone_number') }}" class="form-control"
                                        id="phone_number" name="phone_number">
                                    @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" value="{{ old('email') }}" class="form-control" id="email"
                                        name="email">
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="major">Jurusan</label>
                                    <select class="form-control rounded-0" value="{{ old('major') }}" id="major"
                                        name="major"></select>
                                    @error('major') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="study_program">Program Studi</label>
                                    <select class="form-control rounded-0" id="study_program" name="study_program">
                                    </select>
                                    @error('study_program') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="interested_in">Bidang Minat</label>
                                    <select class="form-control rounded-0" id="interested_in" name="interested_in">
                                        <option @if (old('interested_in') == 'pemrograman') selected @endif value="pemrograman">Pemrograman</option>
                                        <option @if (old('interested_in') == 'jaringan') selected @endif value="jaringan">Jaringan</option>
                                        <option @if (old('interested_in') == 'multimedia') selected @endif value="multimedia">Multimedia</option>
                                        <option @if (old('interested_in') == 'dll') selected @endif value="dll">Dan Lain Lain</option>
                                    </select>
                                    @error('interested_in') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn btn-send" type="button" data-toggle="modal" data-target="#sendData">KIRIM</button>
        
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
@include('admin.components.library')
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('plugins/Venobox/venobox.min.js') }}"></script>
<script src="{{ asset('js/page.js') }}"></script>
<script>
    document.querySelector('#navbar').classList.add('scroll')
    let library = new Library();
    library.onChoiced = (data, args) => {
        library.close();
        document.querySelector(args.parent).classList.add('success');
        document.querySelector(args.parent+' input[type="hidden"]').value = data.id;
        localStorage.setItem(args.name, JSON.stringify({data,args}))
    }

    let els = ['photo','proof_pkkmb','certificate'];
    els.forEach(v => {
        if (localStorage.getItem(v)) {
            let r = JSON.parse(localStorage.getItem(v));
            document.querySelector(r.args.parent).classList.add('success');
            document.querySelector(r.args.parent+' input[type="hidden"]').value = r.data.id;
        }
    })

    let majors = {
        "Teknik Sipil": [
            "Teknologi Rekayasa Konstruksi Jalan dan Jembatan",
            "Teknologi Konstruksi Bangunan Gedung",
            "Teknologi Konstruksi Bangunan Air",
            "Teknologi Konstruksi Jalan dan Jembatan",
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
        ],
        "Tata Niaga": [
            "Akuntansi",
            "Administrasi Bisnis",
            "Perbankan dan Keuangan",
            "Akuntasi Lembaga Keuangan Syariah",
        ],
        "Teknologi Informasi Dan Komputer": [
            "Teknik Informatika",
            "Teknik Rekayasa Komputer Jaringan",
            "Teknik Rekayasa Multi Media",
        ],
    };

    let options = ``;
    for (const key in majors) {
    if (Object.hasOwnProperty.call(majors, key)) {
        options += `<option ${('{{old("major")}}' == key) ? 'selected' : ''} value="${key}">${key}</option>`;
    }
    }
    $('#major').html(options);
    updateProdi();

    $('#major').change(() => {
        updateProdi();
    })

    // Fungsi untuk menampilkan prodi berdasarkan jurusan dalam bentuk tag option
    function updateProdi() {
        let options = ``;
        majors[$('#major').val()].forEach(v => {
        options += `<option ${('{{old("study_program")}}' == v) ? 'selected' : ''} value="${v}">${v}</option>`;
        });
        $('#study_program').html(options);
    }

    function sendData() {
        event.preventDefault();
        let els = ['photo','proof_pkkmb','certificate'];
        els.forEach(v => {
            if (localStorage.getItem(v)) {
                localStorage.removeItem(v)
            }
        })
        document.querySelector('#form').submit();
    }
</script>
@endsection
