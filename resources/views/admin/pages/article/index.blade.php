@extends('admin.layouts.index')

@section('style')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Daftar Artikel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Daftar Artikel</li>
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
      <div class="col-lg-8 col-12">
        <div class="card">
          <div class="card-body">
            <form action="" method="get">
              <div class="row">
                <div class="col-3">
                  <select name="category" class="custom-select">
                    <option value="">Semua</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (Request::get('category') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <input type="text" value="{{ Request::get('search')  }}" class="form-control" placeholder="Cari..." name="search">
                  </div>
                </div>
                <div class="col-2">
                  <button class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
                <tr>
                  <td colspan="5">
                    <button type="button" class="btn btn-block btn-sm btn-primary" data-toggle="modal" data-target="#addArticle">
                      <i class="fa fa-plus"></i>
                    </button>
                  </td>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles->forPage($page, $perPage) as $article)
                  
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="text-capitalize">{{ $article->title }}</td>
                  <td>{{ $article->category }}</td>
                  <td>
                    <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-sm btn-block btn-warning"><i class="fa fa-edit"></i></a>
                  </td>
                  <td>
                    <form action="{{ route('article.destroy', ['id' => $article->id]) }}" method="post">
                    @csrf @method('delete')
                      <button onclick="return confirm('Apakah anda yakin ingin menghapus baris ke {{$loop->iteration}}?')" class="btn btn-sm btn-block btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>

                @endforeach

                @if (empty($articles->forPage($page, $perPage)))
                <tr>
                  <td colspan="6" class="text-center small text-black-50">Data Kosong</td>
                </tr>
                @endif
              </tbody>
            </table>
            @if ($articles->count() > $perPage)
              <form action="" method="get">

                <input type="hidden" name="search" value="{{ Request::get('search') }}">
                @include('admin.components.pagination')
              </form>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Kategori</h4>
          </div>
          <div class="card-body">
            <button class="btn btn-light border btn-block mb-3 text-black-50" data-toggle="modal" data-target="#addCategory" type="button">
              <div class="p-1"><i class="fa fa-plus-circle"></i></div>
            </button>
            @foreach ($categories as $category)
              <div class="alert alert-light small alert-dismissible fade show">
                {{ $category->name }}
                <form action="{{ route('article.category.destroy', ['id' => $category->id]) }}" method="post">
                  @csrf @method('delete')
                  <button onclick="return confirm('Apakah anda yakin ingin melakukan hapus?')" class="close" >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </form>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
{{-- 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#menuTambah">
  Launch demo modal
</button>
 --}}

<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah Kategori</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('article.category.store') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="name" placeholder="Nama kategori..." class="form-control">
            @error('name')
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

<div class="modal fade" id="addArticle" tabindex="-1" aria-labelledby="addArticleLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah Artikel</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('article.store') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="title" placeholder="Judul artikel..." class="form-control">
            @error('title')
              <div class="text-small text-danger">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group mt-3">
            <label for="category">Kategori</label>
            <select name="category_id" id="category" class="form-control">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @error('category_id')
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

@section('script')
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>

@include('admin.components.library')

<script>
  let fd = new FormData();
  fd.append('source_id', 1);
  fd.append('description', 'aa');
  console.log(fd);
  let library = new Library();
  library.onChoiced = (r, p) => {
      library.close();
      axios.post('/api/documentation/event', {
        source_id: r.id,
        description: r.description,
        category_id: p.eventId,
      })
      .then(r => {
        location.reload();
      })
      .catch(e => {
        console.dir(e)
      })
  }
</script>
@endsection
  