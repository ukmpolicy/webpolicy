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
      <div class="col-lg-6 col-12">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('office.store') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="nim">Nim:</label>
                <input type="text" id="nim" name="nim" class="form-control">
                @error('nim') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="role">Jabatan</label>
                <select class="custom-select rounded-0" id="role" name="role">
                  <option value="0">Ketua</option>
                  <option value="1">Sekretaris</option>
                  <option value="2">Bendahara</option>
                  <option value="3">Anggota</option>
                </select>
                @error('role') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="devision_id">Bidang</label>
                <select class="custom-select rounded-0" id="devision_id" name="devision_id">
                  @foreach ($devisions as $devision)
                    <option value="{{ $devision->id }}">{{ $devision->name }}</option>
                  @endforeach
                </select>
                @error('devision_id') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="period_start_at">Periode Tahun Mulai:</label>
                <input type="number" value="{{ date('Y') }}" id="period_start_at" name="period_start_at" class="form-control">
                @error('period_start_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="period_end_at">Periode Tahun Berakhir:</label>
                <input type="number" value="{{ date('Y') + 1 }}" id="period_end_at" name="period_end_at" class="form-control">
                @error('period_end_at') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <button type="submit" class="btn btn-primary btn-block">Tambah</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

@section('script')
<script>
</script>
@endsection

@endsection
  