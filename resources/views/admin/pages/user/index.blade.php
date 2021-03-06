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
      <div class="card-header">
            
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
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>#</td>
              <td>Username</td>
              <td>Tingkat</td>
              <td>Edit</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            @if (empty($users)) 
            <tr>
              <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
            </tr>
            @endif
            @foreach ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->level }}</td>
                <td>
                  <button class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#editUser-{{$user->id}}"><i class="fa fa-edit"></i></button>
                </td>
                <td>
                  <form action="{{ route('user.destroy', ['id' => $user->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              
              <div class="modal fade" id="editUser-{{$user->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                        @csrf @method('put')
                        <div class="form-group">
                          <label for="username">Username:</label>
                          <input type="text" value="{{ $user->username }}" id="username" name="username" class="form-control">
                          @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                          <label for="level">Tingkat:</label>
                          <input type="number" value="{{ $user->level }}" min="0" id="level" name="level" class="form-control">
                          @error('level') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" id="password" name="password" class="form-control">
                          @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                          <label for="cpassword">Konfirmasi Password:</label>
                          <input type="password" id="cpassword" name="cpassword" class="form-control">
                          @error('cpassword') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                      <button type="submit" class="btn btn-primary">Ubah</button>
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
      </div>
    </div>
  </div>

</section>

<div class="modal fade" id="addUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="form-control">
            @error('username') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="level">Tingkat:</label>
            <input type="number" min="0" id="level" name="level" class="form-control">
            @error('level') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="cpassword">Konfirmasi Password:</label>
            <input type="password" id="cpassword" name="cpassword" class="form-control">
            @error('cpassword') <div class="text-danger">{{ $message }}</div> @enderror
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
  