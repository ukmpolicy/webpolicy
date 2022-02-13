@extends('admin.layouts.index')

@section('content')

{{-- Header --}}
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      {{-- Title --}}
      <div class="col-sm-6">
        <h1 class="m-0">Peserta Lomba</h1>
      </div>
      {{-- End Title --}}

      {{-- Breadcrumb --}}
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">CCT</li>
          <li class="breadcrumb-item active">Peserta Lomba</li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </div>
      {{-- End Breadcrumb --}}

    </div>
  </div>
</div>
{{-- End Header --}}

{{-- Content --}}
<section class="content">
  
  <div class="container-fluid">

    {{-- Alert --}}
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
    {{-- End Alert --}}

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            {{-- Content Header --}}
            <div class="d-lg-flex" style="justify-content: space-between">
            </div>
            {{-- End Content Header --}}

            {{-- Data --}}
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
              <tbody></tbody>
            </table>
            {{-- End Data --}}
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- End Content --}}

@endsection
  