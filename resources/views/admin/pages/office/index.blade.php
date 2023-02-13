@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Pengurus</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Pengurus</li>
          <li class="breadcrumb-item active"></li>
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
    @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class="d-lg-flex" style="justify-content: space-between">
          <div class="d-flex">
            <div>
              <form action="" id="filter_period">
                <select name="period" onchange="document.querySelector('#filter_period').submit()" class="form-control" style="width: fit-content">
                  @foreach ($periods as $period)
                    <option @if ($period->id == Request::get('period') || $period->id == $period_active->id) selected @endif value="{{ $period->id }}">Periode {{ $period->name }}</option>
                  @endforeach
                </select>
              </form>
            </div>
          </div>
          <form class="d-flex" method="GET" action="">
            <input type="hidden" name="status" value="{{ Request::get('status') }}">
            {{-- <input type="hidden" name="page" value="{{ Request::get('page') }}"> --}}
            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="width: 300px" placeholder="Cari">
            <div>
              <button class="btn ml-2 btn-primary"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
        <table class="table table-bordered mt-2">
          <thead>
            <tr>
              <td>#</td>
              <td>Gambar</td>
              <td>NIM</td>
              <td>Nama</td>
              <td>Jabatan</td>
              <td>Periode</td>
              <td>Edit</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="8">
                <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modalAddOfficer"><i class="fa fa-plus"></i></button>
              </td>
            </tr>
            @foreach ($officers->forPage($page, $perPage) as $officer)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  <a href="{{ asset('/uploads/'.$officer->picture) }}" target="_blank" rel="noopener noreferrer" class="btn btn-success w-100 btn-sm"><i class="fa fa-image"></i></a>
                </td>
                <td>{{ $officer->nim }}</td>
                <td>{{ $officer->name }}</td>
                <td>{{ $officer->position }}</td>
                <td>{{ $officer->period }}</td>
                <td>
                  <button class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalEditOfficer{{$officer->id}}"><i class="fa fa-edit"></i></button>
                </td>
                <td>
                  <form action="{{ route('office.destroy', ['id' => $officer->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>

              {{-- Modal Edit --}}
              <div class="modal fade" id="modalEditOfficer{{$officer->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Pengurus</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('office.update', ['id' => $officer->id]) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                          <label>Nama:</label>
                          <input type="text" disabled value="{{ $officer->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="name">Nim:</label>
                          <input type="text" id="nim" name="nim" value="{{ $officer->nim }}" class="form-control" required>
                          @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                          <label for="name">Jabatan:</label>
                          <select class="form-control" name="position_id" required>
                            @foreach ($positions as $position)
                              <option value="{{ $position->id }}" @if ($position->id == $officer->position_id) selected @endif>{{ $position->name }}</option>
                            @endforeach
                          </select>
                          @error('position_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                          <label for="name">Gambar:</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="picture" name="picture">
                            <label class="custom-file-label" for="picture">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                          </div>
                          @error('position_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            @endforeach
          </tbody>
        </table>
        @if ($officers->count() > $perPage)
          <form action="" method="get">
            <input type="hidden" name="search" value="{{ Request::get('search') }}">
            @include('admin.components.pagination')
          </form>
        @endif
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
<div class="modal fade" id="modalAddOfficer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengurus</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('office.store') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nim:</label>
            <input type="text" id="nim" name="nim" class="form-control" required>
            @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="name">Jabatan:</label>
            <select class="form-control" name="position_id" required>
              @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
              @endforeach
            </select>
            @error('position_id') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="name">Gambar:</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="picture" name="picture" required>
              <label class="custom-file-label" for="picture">Choose file...</label>
              <div class="invalid-feedback">Example invalid custom file feedback</div>
            </div>
            @error('position_id') <div class="text-danger">{{ $message }}</div> @enderror
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
<script>
</script>
@endsection

  