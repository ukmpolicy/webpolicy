@extends('admin.layouts.index')


@section('style')
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
    <form action="{{ route('member.update', ['id' => $member->id]) }}" method="post">
      @csrf @method('put')
    <div class="row">
      
      <div class="col-md-6">
        
        <div class="card card-primary">
          <!-- form start -->
          <div class="card-body">
              <div id="choiceImage" onclick="library.open('#profile_picture_form')">
                @if ($image)
                  <img src="{{ asset('uploads/library/'.$image->path) }}" id="profile_picture" alt="{{ $image->description }}">
                @endif
                <div class="label"><i class="fa fa-edit"></i></div>
                <input type="hidden" value="{{ $member->profile_picture }}" name="profile_picture" id="profile_picture_form">
              </div>
              @error('profile_picture')
                <div class="text-center text-danger">{{ $message }}</div>
              @enderror
              <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary btn-block btn-sm">Simpan Perubahan</button>
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
                <input type="date" value="{{ date('Y-m-d', strtotime($member->born_at)) }}" class="form-control" id="born_at" name="born_at">
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
          <!-- form start -->
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
                <label for="interested_in">Bidang Minat</label>
                <select class="custom-select rounded-0" id="interested_in" name="interested_in">
                  <option @if ($member->interested_in == 'pemrograman') selected @endif value="pemrograman">Pemrograman</option>
                  <option @if ($member->interested_in == 'jaringan') selected @endif value="jaringan">Jaringan</option>
                  <option @if ($member->interested_in == 'multimedia') selected @endif value="multimedia">Multimedia</option>
                </select>
                @error('interested_in') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="joined_at">Tahun Bergabung</label>
                <input type="number" class="form-control" value="{{ $member->joined_at }}" id="joined_at" name="joined_at">
                @error('joined_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="interested_in">Status</label>
                <select class="custom-select rounded-0" id="status" name="status">
                  @foreach ($status as $k => $v)
                  <option @if ($member->status == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                  @endforeach

                </select>
                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
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


<div class="modal fade" id="modalAddMember">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Anggota</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('member.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="add_nim">Nim:</label>
            <input type="text" id="add_nim" name="nim" class="form-control">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="add_name">Nama:</label>
            <input type="text" id="add_name" name="name" class="form-control">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection

@section('script')

<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>

@include('admin.components.library')

<script>
  let library = new Library();
  library.onChoiced = (r) => {
      library.close();
      let image = document.querySelector('#profile_picture');
      console.log(image);
      document.querySelector('#profile_picture').src = `{{ asset('') }}${r.path}`;
  }
</script>

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
</script>
@endsection
  