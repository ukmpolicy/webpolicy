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
      <div class="col-md-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="d-lg-flex" style="justify-content: space-between">
              <div class="d-flex">
                <form action="" method="get" id="sb">
                  <select class="form-control mb-2" name="sb" onchange="document.querySelector('#sb').submit()" style="width: fit-content">
                    <option value="" @if (Request::get('sb')) selected @endif>Semua</option>
                    <option value="d" @if (Request::get('sb') == 'd') selected @endif>Selesai</option>
                    <option value="ny" @if (Request::get('sb') == 'ny') selected @endif>Belum</option>
                  </select>
                </form>
                <div>
                  <a href="{{ route('member.or.download', $_GET) }}" class="btn ml-2 btn-success"><i class="fa fa-print fa-fw mr-2"></i>CETAK</a>
                </div>
              </div>
              <form class="d-flex" method="GET" action="">
                <input type="hidden" name="sb" value="{{ Request::get('sb') }}">
                <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="width: 300px" placeholder="Cari">
                <div>
                  <button class="btn ml-2 btn-primary"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nim</th>
                  <th>Nama</th>
                  <th>Jurusan</th>
                  <th>No.HP</th>
                  <th>Menyerahkan Berkas</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members as $member)
                  
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $member->nim }}</td>
                  <td>{{ $member->name }}</td>
                  <td>{{ $member->phone_number }}</td>
                  <td>{{ $member->major }}</td>
                  <td>
                    <form action="{{ route('member.or.done', ['id' => $member->id]) }}" class="d-inline-block w-100" method="POST">
                      @csrf
                      @if ($member->store_document)
                        <button class="btn btn-secondary w-100 btn-sm">CANCEL</button>
                      @else
                        <button class="btn btn-dark w-100 btn-sm">DONE</button>
                      @endif
                    </form>
                  </td>
                </tr>

                @endforeach

                @if ($members->isEmpty())
                <tr>
                  <td colspan="6" class="text-center small text-black-50">Data Kosong</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination m-0 float-right">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</section>

@endsection
  