@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Masukan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Masukan</li>
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
              <td>Name</td>
              <td>Email</td>
              <td>Tempilkan</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            @if (empty($users)) 
            <tr>
              <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
            </tr>
            @endif
            @foreach ($mails as $mail)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mail->name }}</td>
                <td>{{ $mail->email }}</td>
                <td>
                  <a href="{{ route('mail.detail') }}" class="btn btn-primary btn-sm">Tampilkan</a>
                </td>
                <td>
                  <form action="{{ route('mail.destroy', ['id' => $mail->id]) }}" method="post">
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

@section('script')
<script>
</script>
@endsection

@endsection
  