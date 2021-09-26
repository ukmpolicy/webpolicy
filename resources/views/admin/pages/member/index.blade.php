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
          <div class="card-header">
            {{-- <h3 class="card-title mt-1">Bordered Table</h3> --}}
            
            <div class="card-tools ml-3 mt-1">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div> 
            </div>
            
            <div class="card-tools">
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddMember"><i class="fa fa-plus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nim</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members as $member)
                  
                <tr>
                  <td>{{ $loop->iteration }}</td>
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
<!-- /.content -->

@section('script')
<script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
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
  