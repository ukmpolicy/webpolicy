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
          <a href="{{ route('office.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
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
            @if (empty($officers)) 
            <tr>
              <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
            </tr>
            @endif
            @foreach ($officers as $officer)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $officer['member'] }}</td>
                <td>{{ $officer['role'] }}</td>
                <td>{{ $officer['devision'] }}</td>
                <td>{{ $officer['period_start_at'] . '-' . $officer['period_end_at'] }}</td>
                <td>
                  <a href="{{ route('office.edit', ['id' => $officer['id']]) }}" class="btn btn-warning btn-sm btn-block"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                  <form action="{{ route('office.destroy', ['id' => $officer['id']]) }}" method="post">
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

@section('script')
<script>
</script>
@endsection

@endsection
  