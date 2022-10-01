@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pengaturan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">Open Recruitment</li>
          <li class="breadcrumb-item active">Pengaturan</li>
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
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
      <div class="col-6">

        <form action="{{ route('open-recruitment.admin.setting.save') }}" method="post">
          @csrf
          <h5># Pendaftaran</h5>
          <div class="form-group">
            <label for="or_setting_status">Status:</label>
            <select name="or_setting_status" id="or_setting_status" class="custom-select rounded-0">
              <option value="0" @if ($or_setting_status==0) selected @endif>Sesuai Jadwal</option>
              <option value="1" @if ($or_setting_status==1) selected @endif>Buka</option>
              <option value="2" @if ($or_setting_status==2) selected @endif>Tutup</option>
            </select>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="or_setting_start">Jadwal Buka:</label>
              </div>
              <div class="col-6">
                <div class="small text-black-50">
                  Format: b/t/h, j:m am/pm
                </div>
              </div>
            </div>
            <input id="or_setting_start" name="or_setting_start" type="datetime-local" value="{{ date('Y-m-d\TH:i:s', strtotime($or_setting_start)) }}" class="form-control">
            @error('or_setting_start') <div class="small text-danger">{{ $message }}</div> @endif
          </div>
          <div class="form-group">
            <div class="col-6">
              <label for="or_setting_start">Jadwal Tutup:</label>
            </div>
            <div class="col-6">
              <div class="small text-black-50">
                Format: b/t/h, j:m am/pm
              </div>
            </div>
            <input id="or_setting_end" name="or_setting_end" type="datetime-local" value="{{ date('Y-m-d\TH:i:s', strtotime($or_setting_end)) }}" class="form-control">
            @error('or_setting_end') <div class="small text-danger">{{ $message }}</div> @endif
          </div>
          <button class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>

</section>

@endsection
  