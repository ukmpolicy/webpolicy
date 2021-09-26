@extends('user.layout')
@section('d_style') 
<style>
    
  #choiceImage {
    margin: auto;
    height: 200px;
    width: 200px;
    padding: .2rem;
    position: relative;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ddd;
    border-radius: 4px;
  }
  #choiceImage img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  #choiceImage .label {
    left: .2rem;
    top: .2rem;
    right: .2rem;
    bottom: .2rem;
    cursor: pointer;
    display: flex;
    transition: .3s;
    border-radius: 4px;
    position: absolute;
    align-items: center;
    justify-content: center;
  }
  
  #choiceImage:hover .label {
    background-color: rgba(0,0,0,.5);
    color: #fff;
  }
  #kirim {
      width: 100%;
      padding: 8px 16px;
      margin-top: 1rem;
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
            <form action="{{ route('main.recruitment.store') }}" method="post">
                @csrf
                <div class="row">
        
                    <div class="col-md-6">
        
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">
                                <div id="choiceImage" onclick="library.open('#profile_picture_form')">
                                    <img src="" id="profile_picture" alt="">
                                    <div class="label"><i class="fa fa-edit"></i></div>
                                    <input type="hidden" value="" name="profile_picture" id="profile_picture_form">
                                </div>
                                @error('profile_picture')
                                    <div class="text-center text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group mt-2">
                                    <button type="submit" id="kirim" class="btn btn-danger btn-block btn-sm">Kirim Berkas</button>
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
                                    </select>
                                    @error('interested_in') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
        
                    </div>
        
                </div>
            </form>
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
    library.onChoiced = (r) => {
        library.close();
        let image = document.querySelector('#profile_picture');
        console.log(image);
        document.querySelector('#profile_picture').src = `{{ asset('') }}${r.path}`;
    }
    let majors = {
        "Teknik Elektro": [
            "Teknik Listrik",
            "Teknik Telekomunikasi",
            "Teknik Elektronika",
            "Instrumentasi dan Otomasi Industri",
            "Teknik Jaringan Telekomunikasi",
            "Teknik Pembangkit Energi Listrik",
        ],
        "Teknologi Informasi Dan Komputer": [
            "Teknologi Informasi",
            "Teknik Rekayasa Komputer Jaringan",
            "Teknik Rekayasa Multi Media"
        ],
        "Teknik Sipil": [
            "Teknik Sipil D3",
            "Teknik Sipil D4"
        ],
        "Teknik Kimia": [
            "Teknologi Kimia Industri",
            "Teknik Kimia D3",
            "Pengolahan Minyak dan Gas Bumi"
        ],
        "Teknik Mesin": [
            "Teknik Mesin D3",
            "Teknik Mesin D4",
        ],
        "Tata Niaga": [
            "Akuntansi",
            "Keuangan dan Perbankan",
            "Keuangan dan Perbankan Syariah",
            "Administrasi Bisnis"
        ]
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
</script>
@endsection
