@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Bidang</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Daftar Bidang</li>
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
    @if (session('failed'))
    <div class="alert alert-danger">
      {{ session('failed') }}
    </div>
    @endif
    <div class="card">
      <div class="card-body">
        <form action="" id="filter_period">
          <select name="period" onchange="document.querySelector('#filter_period').submit()" class="form-control" style="width: fit-content">
            @foreach ($periods as $period)
              <option @if ($period->id == Request::get('period') || $period->id == $period_active->id) selected @endif value="{{ $period->id }}">Periode {{ $period->name }}</option>
            @endforeach
          </select>
        </form>
        <table class="table table-bordered mt-2">
          <thead>
            <tr>
              <td>#</td>
              <td>Nama</td>
              <td>Periode</td>
              <td>Edit</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="5">
                <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modalAddDivision"><i class="fa fa-plus"></i></button>
              </td>
            </tr>
            @foreach ($divisions as $division)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $division->name }}</td>
                <td>{{ $division->period }}</td>
                <td>
                  <a href="{{ route('division.edit', ['id' => $division->id]) }}" class="btn btn-warning btn-sm btn-block"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                  <form action="{{ route('division.destroy', ['id' => $division->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->

<div class="modal fade" id="modalAddDivision">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Anggota</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('division.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" class="form-control">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="name">Periode:</label>
            {{-- <input type="text" id="name" name="name" class="form-control"> --}}
            <select class="form-control" name="period_id">
              @foreach ($periods as $period)
                <option value="{{ $period->id }}">{{ $period->name }}</option>
              @endforeach
            </select>
            @error('period_id') <div class="text-danger">{{ $message }}</div> @enderror
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

@section('script')
<script>
</script>
@endsection

@endsection
  