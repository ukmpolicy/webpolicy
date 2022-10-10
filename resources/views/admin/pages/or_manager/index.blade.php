@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Peserta</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Open Recruitment</li>
          <li class="breadcrumb-item active">Daftar Peserta</li>
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
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="d-lg-flex" style="justify-content: space-between">
              <a href="{{ route('open-recruitment.admin.download') }}" class="btn btn-success"><i class="fa fa-download mr-2"></i> Unduh</a>
              <form class="d-flex" method="GET" action="">
                {{-- <input type="hidden" name="sb" value="{{ Request::get('sb') }}"> --}}
                <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="width: 300px" placeholder="Cari">
                <div>
                  <button class="btn ml-2 btn-primary"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
            <table class="table table-bordered mt-2">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Foto</th>
                  <th>Nim</th>
                  <th>Nama</th>
                  <th>Jurusan / Prodi</th>
                  <th>No Whatsapp</th>
                  <th>Tanggal Lahir</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members->forPage($page, $perPage) as $member)
                  
                <tr>
                  <td>{{ (($page - 0) * $perPage) + $loop->iteration }}</td>
                  <td>
                    <a href="{{ asset('uploads/'.$member->pas_foto ) }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success w-100">
                      <i class="fa fa-image"></i>
                    </a>
                  </td>
                  <td>{{ $member->nim }}</td>
                  <td style="text-transform: capitalize">{{ $member->nama }}</td>
                  <td style="text-transform: capitalize">{{ $member->jurusan . ' / ' . $member->prodi }}</td>
                  <td>{{ $member->no_wa }}</td>
                  <td>{{ date('d M Y', strtotime($member->tgl_lahir)) }}</td>
                  <td>
                    <form action="{{ route('open-recruitment.admin.destroy', ['id' => $member->id]) }}" method="post">
                      @csrf
                      @method('delete')
                      <button onclick="confirm('Apakah anda yakin ingin menghapus baris ini?')" class="btn btn-danger btn-sm w-100"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>

                @endforeach

                @if ($members->forPage($page, $perPage)->isEmpty())
                <tr>
                  <td colspan="8" class="text-center small text-black-50">Data Kosong</td>
                </tr>
                @endif
              </tbody>
            </table>
            @if ($members->count() > $perPage)
              <form action="" method="get">
                <input type="hidden" name="search" value="{{ Request::get('search') }}">
                @include('admin.components.pagination')
              </form>
            @endif
          </div>
          <!-- /.card-body --
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</section>

@endsection
  