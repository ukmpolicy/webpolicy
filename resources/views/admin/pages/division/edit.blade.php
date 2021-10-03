@extends('admin.layouts.index')

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
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Anggota</li>
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
    <div class="row">
      <div class="col-lg-4 col-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('division.update', ['id' => $division->id]) }}" method="post">
              @csrf @method('put')
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" value="{{ $division->name }}" id="name" name="name" class="form-control">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <button type="submit" class="btn btn-primary btn-block">Ubah</button>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">Pengurus</div>
          <div class="card-body">
            @foreach ($officers as $officer)
              <div class="alert alert-light text-capitalize">
                {{ $officer['member']->name }}
                <span class="small text-black-50 ml-1">#{{ $officer['role'] }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-12">
        <div class="card">
          <div class="card-header">Program Kerja</div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Nama</td>
                  <td>Tanggal</td>
                  <td>Edit</td>
                  <td>Hapus</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="5">
                    <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#addProgram">
                      <i class="fa fa-plus circle"></i> <span class="ml-1">Tambah Proker</span>
                    </button>
                  </tr>
                </td>
                @foreach ($programs as $program)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $program->name }}</td>
                  <td>{{ date('Y-m-d', strtotime($program->start_at)) }}</td>
                  <td>
                    <button class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#editProgram-{{ $program->id }}"><i class="fa fa-edit"></i></button>
                  </td>
                  <td>
                    <button class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                
                <div class="modal fade" id="editProgram-{{ $program->id }}" tabindex="-1" aria-labelledby="editProgramLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="modal-title">Edit Program Kerja</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('division.program.update', ['division_id' => $division->id, 'program_id' => $program->id]) }}" method="post">
                          @csrf
                          <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="name" value="{{ $program->name }}" placeholder="Nama acara..." class="form-control">
                            @error('name')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal Mulai</label>
                            <input type="date" value="{{ date('Y-m-d', strtotime($program->start_at)) }}" name="start_at" placeholder="Tanggal mulai..." class="form-control">
                            @error('start_at')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control" placeholder="Deskripsi" cols="30" rows="4">{{ $program->description }}</textarea>
                            @error('description')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <button class="btn btn-block btn-primary">TAMBAHKAN</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<div class="modal fade" id="addProgram" tabindex="-1" aria-labelledby="addProgramLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah Program Kerja</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('division.program.store', ['division_id' => $division->id]) }}" method="post">
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="name" placeholder="Nama acara..." class="form-control">
            @error('name')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Mulai</label>
            <input type="date" name="start_at" placeholder="Tanggal mulai..." class="form-control">
            @error('start_at')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="description" class="form-control" placeholder="Deskripsi" cols="30" rows="4"></textarea>
            @error('description')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary">TAMBAHKAN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@section('script')
<script>
</script>
@endsection

@endsection
  