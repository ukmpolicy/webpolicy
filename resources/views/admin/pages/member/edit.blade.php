@extends('admin.layouts.index')


@section('style')
<style>
  .choice-file {
    margin: auto;
    height: 240px;
    width: 200px;
    padding: .2rem;
    position: relative;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ddd;
    border-radius: 4px;
  }
  .choice-file img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  .choice-file .label {
    left: .2rem;
    top: .2rem;
    right: .2rem;
    bottom: .2rem;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    transition: .3s;
    border-radius: 4px;
    position: absolute;
    align-items: center;
    justify-content: center;
  }

  .choice-file .success .label {
    opacity: 0;
  }
  
  .choice-file .success:hover .label {
    background-color: rgba(0,0,0,.5);
    color: #fff;
    opacity: 1;
  }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Anggota</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('member') }}">Anggota</a></li>
          <li class="breadcrumb-item active">{{ $member->nim }}</li>
          {{-- <li class="breadcrumb-item active"></li> --}}
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  
  <div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    @if (session('failed'))
    <div class="alert alert-danger">
      {{ session('failed') }}
    </div>
    @endif
    <form action="{{ route('member.update', ['id' => $member->id]) }}" method="post" enctype="multipart/form-data">
      @csrf @method('put')
    <div class="row">
      
      <div class="col-md-6">
        
        <div class="card card-primary">
          <!-- form start -->
          <div class="card-body">
            <div class="row">

              {{-- Photo --}}
              <div class="col-lg-6">
                <div class="choice-file" id="photo" onclick="choiceFile('photo')">
                  @if ($member)
                    <img src="{{ asset('uploads/'.$member->profile_picture) }}" id="photo" alt="{{ $member->name }}">
                  @endif
                  
                  <div class="normal">
                    <div class="label">
                      <div class=""><i class="fa fa-edit"></i></div>
                      <b>Tap to upload</b>
                    </div>
                  </div>
                  <div class="success">
                    <div class="label">
                      <div class=""><i class="fa fa-edit"></i></div>
                      <b>Tap to change</b>
                    </div>
                  </div>

                  <input type="file" class="d-none file-selector" value="" name="photo">
                  <input type="hidden" class="file-value" name="photo-value" value="{{ $member->photo }}">
                </div>
                @error('photo')
                  <div class="text-center text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-6">

                {{-- Status --}}
                <div class="d-flex align-items-center mb-2">
                  <div class="d-inline-block text-primary mr-2" style="font-size: 8px;margin-top: 2px;">
                    <i class="fa fa-circle"></i>
                  </div>
                  <div>Status: <b class="text-capitalize">Anggota tidak tetap</b></div>
                </div>
                
                {{-- Detail --}}
                <textarea name="other_detail" cols="30" rows="6" placeholder="Other Detail" class="form-control">{{ $member->other_detail }}</textarea>

                {{-- Save Button --}}
                <div class="form-group mt-2">
                  <button type="submit" class="btn btn-primary btn-block btn-sm">Simpan Semua Perubahan</button>
                </div>
              </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="card card-primary">
          <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" value="{{ $member->nim }}" class="form-control" id="nim" name="nim">
                @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" value="{{ $member->name }}" class="form-control" id="name" name="name">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" value="{{ $member->address }}" class="form-control" id="address" name="address">
                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="born_at">Tanggal Lahir</label>
                <input type="date" value="{{ date('Y-m-d', $member->born_at) }}" class="form-control" id="born_at" name="born_at">
                @error('born_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="birth_place">Tempat Lahir</label>
                <input type="text" value="{{ $member->birth_place }}" class="form-control" id="birth_place" name="birth_place">
                @error('birth_place') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      

      <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-body">
              <div class="form-group">
                <label for="phone_number">Nomor Handphone</label>
                <input type="number" value="{{ $member->phone_number }}" class="form-control" id="phone_number" name="phone_number">
                @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ $member->email }}" class="form-control" id="email" name="email">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
            </div>
        </div>

        <div class="card">
          <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label for="major">Jurusan</label>
                <select class="custom-select rounded-0" value="{{ $member->major }}" id="major" name="major"></select>
                @error('major') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="study_program">Program Studi</label>
                <select class="custom-select rounded-0" id="study_program" name="study_program">
                </select>
                @error('study_program') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="joined_at">Tahun Bergabung</label>
                <input type="number" class="form-control" value="{{ $member->joined_at }}" id="joined_at" name="joined_at">
                @error('joined_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="graduation_at">Tahun Lulus</label>
                <input type="number" class="form-control" value="{{ $member->graduation_at }}" id="graduation_at" name="graduation_at">
                @error('graduation_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
            </div>
        </div>
        <!-- /.card -->

      </div>

    </div>
    </form>
    <!-- /.row -->
  </div>

</section>

@endsection

@section('script')

{{-- <script src="{{ asset('plugins/axios/axios.min.js') }}"></script> --}}

{{-- @include('admin.components.library') --}}

{{-- <script>
  let library = new Library();
  library.onChoiced = (r) => {
      library.close();
      let image = document.querySelector('#profile_picture');
      console.log(image);
      document.querySelector('#profile_picture').src = `{{ asset('') }}${r.path}`;
  }
</script> --}}

<script>
  // Deklarasi Librari Toast
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  // Alert Untuk Setiap Pesan Sukses
  if ('{{ session('success') }}'.trim() != '') {
    setTimeout(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Berhasil',
        body: '{{ session('success') }}'
      })
      }, 10)
  }

  // console.log('a')
  // Mengambil Data Jurusan
  let majors = '{{ $majors }}';
  setTimeout(() => {
    majors = majors.replace(/&quot;/g,'"');
    majors = JSON.parse(majors);
    let options = ``;
    for (const key in majors) {
      if (Object.hasOwnProperty.call(majors, key)) {
        let selected = '{{$member->major}}'.toLocaleLowerCase() == key.toLocaleLowerCase();
        options += `<option ${(selected) ? 'selected' : ''} value="${key}">${key}</option>`;
      }
    }
    $('#major').html(options);
    updateProdi();
  },20)
  $('#major').change(() => {
    updateProdi();
  })

  // Fungsi untuk menampilkan prodi berdasarkan jurusan dalam bentuk tag option
  function updateProdi() {
    let options = ``;
    majors[$('#major').val()].forEach(v => {
      options += `<option ${('{{$member->study_program}}'.toLowerCase( ) == v.toLowerCase()) ? 'selected' : ''} value="${v}">${v}</option>`;
    });
    $('#study_program').html(options);
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
          document.querySelector('#' + id + ' .file-value').value = true;
          checkFileInputs();
      }
      document.querySelector('#' + id + ' .file-selector').click();
        // checkFileInputs();
    }
</script>
@endsection
  