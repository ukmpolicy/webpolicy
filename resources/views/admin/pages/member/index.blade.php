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
          <li class="breadcrumb-item">Data Organinsasi</li>
          <li class="breadcrumb-item active">Daftar Anggota</li>
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
    @elseif (session('failed'))
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
              <div class="d-flex">
                <div>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddMember"><i class="fa fa-plus fa-fw mr-2"></i>Tambah</button>
                  <button class="btn btn-success" data-toggle="modal" data-target="#modalImportMember"><i class="fa fa-file-import mr-2 fa-fw"></i>Import</button>
                  <form action="" method="get" id="filter_rows" class="d-inline-block">
                    <select class="form-control" name="rows" onchange="document.querySelector('#filter_rows').submit()">
                      <option @if ('10' == Request::get('rows')) selected @endif value="10">10 Baris</option>
                      <option @if ('50' == Request::get('rows')) selected @endif value="50">50 Baris</option>
                      <option @if ('100' == Request::get('rows')) selected @endif value="100">100 Baris</option>
                      <option @if ('all' == Request::get('rows')) selected @endif value="all">Semua</option>
                    </select>
                  </form>
                </div>
              </div>
              <form class="d-flex" method="GET" action="">
                <input type="hidden" name="status" value="{{ Request::get('status') }}">
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
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members->forPage($page, $perPage) as $member)
                  
                <tr>
                  <td>{{ (($page - 1) * $perPage) + $loop->iteration }}</td>
                  <td>
                    <a href="{{ asset('uploads/'.$member->profile_picture) }}" class="btn btn-sm btn-success w-100 @if (!$member->profile_picture) disabled @endif" target="_blank" rel="noopener noreferrer">
                      <i class="fa fa-image"></i>
                    </a>
                  </td>
                  <td>{{ $member->nim }}</td>
                  <td>{{ $member->name }}</td>
                  <td>{{ $status[$member->status] }}</td>
                  <td>
                    <a href="{{ route('member.edit', ['id' => $member->id]) }}" class="btn btn-sm btn-block btn-warning"><i class="fa fa-edit"></i></a>
                  </td>
                  <td>
                    <form action="{{ route('member.delete', ['id' => $member->id]) }}" method="post">
                    @csrf @method('delete')
                      <button onclick="return confirm('Apakah anda yakin ingin menghapus anggota dengan nim {{ $member->nim }}?')" class="btn btn-sm btn-block btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>

                @endforeach

                @if ($members->forPage($page, $perPage)->isEmpty())
                <tr>
                  <td colspan="6" class="text-center small text-black-50">Data Kosong</td>
                </tr>
                @endif
              </tbody>
            </table>

            @if ($members->count() > $perPage)
              <form action="" method="get">

                <input type="hidden" name="status" value="{{ Request::get('status') }}">
                <input type="hidden" name="search" value="{{ Request::get('search') }}">
                @include('admin.components.pagination')
              </form>
            @endif
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
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

{{-- Modal Import Member --}}
<div class="modal fade" id="modalImportMember">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Import Anggota</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('member.import') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group">
            <label for="file_import">File Import:</label>
            <div class="custom-file">
              <input type="file" id="file_import" name="file_import" class="custom-file-input">
              <label class="custom-file-label" id="custom-file-import" for="file_import">Choose file</label>
            </div>
            @error('file_import') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <p>
            Unduh format import <a href="{{ asset('format_import_member.xlsx') }}">disini</a>.
          </p>
          <p>
            Beberapa hal yang harus diperhatikan:
          </p>
          <ol>
            <li>Format tanggal lahir seperti berikut: bulan/tanggal/tahun</li>
            <li>Format nomor hp di awali dengan kode negara, contoh: 6285300000000</li>
          </ol>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary">Import</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@section('script')
<script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  $('#file_import').on('change',function(){
      //get the file name
      var fileName = $(this).val().split('\\');
      //replace the "Choose a file" label
      $('#custom-file-import').html(fileName[fileName.length-1]);
  })
  if ('{{ session('success') }}'.trim() != '') {
    setTimeout(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Berhasil',
        body: '{{ session('success') }}'
      })
      }, 10)
  }
</script>
@endsection

@endsection
  