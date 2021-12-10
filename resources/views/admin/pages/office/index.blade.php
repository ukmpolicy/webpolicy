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
    @if (session('failed'))
    <div class="alert alert-danger">
      {{ session('failed') }}
    </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class="d-lg-flex" style="justify-content: space-between">
          <div class="d-flex">
            <div>
              <a href="{{ route('office.create') }}" class="btn btn-success"><i class="fa fa-plus fa-fw mr-2"></i>Tambah</a>
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
              <td>Nama</td>
              <td>Jabatan</td>
              <td>Bidang</td>
              <td>Periode</td>
              <td>Edit</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            @if ($officers->forPage($page, $perPage)->isEmpty())
            <tr>
              <td colspan="7" class="text-center small text-black-50">Data Kosong</td>
            </tr>
            @endif
            @foreach ($officers->forPage($page, $perPage) as $officer)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $officer->name }}</td>
                <td>{{ $roles[$officer->role] }}</td>
                <td>{{ $officer->division }}</td>
                <td>{{ $officer->period_start_at . '-' . $officer->period_end_at }}</td>
                <td>
                  <a href="{{ route('office.edit', ['id' => $officer->id]) }}" class="btn btn-warning btn-sm btn-block"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                  <form action="{{ route('office.destroy', ['id' => $officer->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
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

@section('script')
<script>
</script>
@endsection

@endsection
  