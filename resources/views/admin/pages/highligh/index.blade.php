@extends('admin.layouts.index')

@section('style')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Sorotan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Daftar Sorotan</li>
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

    {{-- Highligh --}}
    <div class="row">
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Judul</th>
                  <th>Url Tombol</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
                <tr>
                  <td colspan="8">
                    <button type="button" class="btn btn-block btn-sm btn-primary" data-toggle="modal" data-target="#addHighligh">
                      <i class="fa fa-plus"></i>
                    </button>
                  </td>
                </tr>
              </thead>
              <tbody>
                @foreach ($highlighs->forPage($page, $perPage) as $highligh)
                  
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-capitalize">{{ $highligh->title }}</td>
                  <td class="text-capitalize">{{ $highligh->subtitle }}</td>
                  <td>
                    <button type="button" class="btn btn-block btn-sm btn-warning" data-toggle="modal" data-target="#editHighligh">
                      <i class="fa fa-edit"></i>
                    </button>
                  </td>
                  <td>
                    <form action="{{ route('highligh.destroy', ['highligh' => $highligh->id]) }}" method="post">
                    @csrf @method('delete')
                      <button onclick="return confirm('Apakah anda yakin ingin menghapus baris ke {{$loop->iteration}}?')" class="btn btn-sm btn-block btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>

                <div class="modal fade" id="editHighligh-{{ $highligh->id }}" tabindex="-1" aria-labelledby="editHighligh-{{ $highligh->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="modal-title">Edit Sorotan</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('highligh.update', ['highligh' => $highligh->id]) }}" enctype="multipart/form-data" method="post">
                          @csrf
                          @method('put')
                          <div class="form-group">
                            <input type="text" name="title" value="{{ $highligh->title }}" placeholder="Judul..." class="form-control">
                            @error('title')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <input type="text" name="subtitle" value="{{ $highligh->subtitle }}" placeholder="Subjudul..." class="form-control">
                            @error('subtitle')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <input type="text" name="text_button" value="{{ $highligh->text_button }}" placeholder="Tulisan Button..." class="form-control">
                            @error('text_button')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <input type="text" name="url_button" value="{{ $highligh->url_button }}" placeholder="Url Button..." class="form-control">
                            @error('url_button')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                            <label class="custom-file-label" for="thumbnail">Thumbnail</label>
                            @error('thumbnail')
                              <div class="text-small text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <button class="btn btn-block btn-primary">SIMPAN PERUBAHAN</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
  
                @endforeach
  
                @if (empty($highlighs->forPage($page, $perPage)))
                <tr>
                  <td colspan="6" class="text-center small text-black-50">Data Kosong</td>
                </tr>
                @endif
              </tbody>
            </table>
            @if ($highlighs->count() > $perPage)
              <form action="" method="get">
  
                <input type="hidden" name="search" value="{{ Request::get('search') }}">
                @include('admin.components.pagination')
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
    {{-- End Highligh --}}
  </div>

</section>

<div class="modal fade" id="addHighligh" tabindex="-1" aria-labelledby="addHighligh" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah Sorotan</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('highligh.store') }}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="title" placeholder="Judul..." class="form-control">
            @error('title')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" name="subtitle" placeholder="Subjudul..." class="form-control">
            @error('subtitle')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" name="text_button" placeholder="Tulisan Button..." class="form-control">
            @error('text_button')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" name="url_button" placeholder="Url Button..." class="form-control">
            @error('url_button')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
            <label class="custom-file-label" for="thumbnail">Thumbnail</label>
            @error('thumbnail')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary">TAMBAHKAN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection