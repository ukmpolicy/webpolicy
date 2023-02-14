@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Role</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Role</li>
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
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRole"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>#</td>
              <td>Nama</td>
              <td>Akses</td>
              <td>Ubah</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>

            @forelse ($roles as $role)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-capitalize">{{ $role->name }}</td>
                <td>
                  <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#access-{{ $role->id }}"><i class="fa fa-lock"></i></button>

                  <div class="modal fade" id="access-{{ $role->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Pengaturan Akses User</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <form action="{{ route('role.add_access', ['id' => $role->id]) }}" method="post">
                            @csrf

                            <div class="form-group">
                              <label for="">Email:</label>
                              <div class="input-group">
                                <input type="email" autocomplete="email" class="form-control" name="email">
                                <div class="input-group-append">
                                  <button class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                              </div>
                            </div>
                          </form>

                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td>#</td>
                                <td>Nama</td>
                                <td>Email</td>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse (DB::table('users')->where('role_id', $role->id)->get() as $user)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                  </tr>
                              @empty
                                <tr>
                                  <td colspan="4" class="small text-center text-black-50">Tidak ada data.</td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </td>
                <td>
                  <button class="btn btn-warning btn-block btn-sm" data-toggle="modal" data-target="#editRole-{{ $role->id }}"><i class="fa fa-edit"></i></button>

                  <div class="modal fade" id="editRole-{{ $role->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Role</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('role.update', ['id' => $role->id]) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group">
                              <label for="name">Name:</label>
                              <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}" required>
                              @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <td>#</td>
                                  <td>Nama</td>
                                </tr>
                              </thead>
                              <tbody>
                                @forelse ($permissions as $permission)
                                  <tr>
                                    <td width="10%">
                                      <input type="checkbox" @if (hasPermission($role->id, $permission->id)) checked @endif name="permissions[]" value="{{ $permission->id }}">
                                    </td>
                                    <td>
                                      {{ $permission->name }}
                                    </td>
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="2" class="small text-center text-black-50">Tidak ada data.</td>
                                  </tr>
                                @endforelse
                              </tbody>
                            </table>
                            
                            <button type="submit" id="tambah_role" class="btn btn-primary w-100">Simpan</button>
                        </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </td>
                <td>
                  @if (in_array(strtolower($role->name), ['admin', 'guest']))
                    <button class="btn btn-danger btn-sm btn-block" disabled><i class="fa fa-trash"></i></button>
                  @else
                  <form action="{{ route('role.destroy', ['id' => $role->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="fa fa-trash"></i></button>
                  </form>
                  @endif
                </td>
                
              </tr>
            @empty
              <tr>
                <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</section>

<div class="modal fade" id="addRole">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('role.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          
          <table class="table table-bordered">
            <thead>
              <tr>
                <td>#</td>
                <td>Nama</td>
              </tr>
            </thead>
            <tbody>
              @forelse ($permissions as $permission)
                <tr>
                  <td width="10%">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                  </td>
                  <td>
                    {{ $permission->name }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
                </tr>
              @endforelse
            </tbody>
          </table>

          <button type="submit" id="tambah_role" class="btn btn-primary w-100">Tambah</button>
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
  