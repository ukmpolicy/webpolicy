@extends('admin.layouts.index')

@section('style')
<!-- summernote -->
<link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
<style>
  #thumbnail {
    margin: auto;
    height: 150px;
    width: 100%;
    padding: .2rem;
    position: relative;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ddd;
    border-radius: 4px;
  }
  #thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  #thumbnail .label {
    left: .2rem;
    top: .2rem;
    right: .2rem;
    bottom: .2rem;
    cursor: pointer;
    display: flex;
    transition: .3s;
    border-radius: 4px;
    position: absolute;
    align-items: center;
    justify-content: center;
  }
  
  #thumbnail:hover .label {
    background-color: rgba(0,0,0,.5);
    color: #fff;
  }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dokumentasi</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('article') }}">Article</a></li>
          <li class="breadcrumb-item active">Edit Artikel</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  
  <div class="container-fluid">
    <form action="{{ route('article.update', ['id' => $article->id]) }}" method="post">
    <div class="row">
        @csrf @method('put')
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mt-1">Edit Artikel</h4>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="title">Judul</label>
                  <input type="text" name="title" value="{{ $article->title }}" id="title" placeholder="Judul" class="form-control">
                  @error('title')
                    <div class="text-center text-danger">{{ $message }}</div>
                  @enderror
                </div>
  
                <label>Thumbnail</label>
                <div id="thumbnail" onclick="library.open('#thumbnail_form')">
                  <img src="{{ asset(($image) ? $image->path : '') }}" id="thumbnail_image" alt="{{ ($image) ? $image->description : '' }}">
                  <div class="label"><i class="fa fa-edit"></i></div>
                  <input type="hidden" @if ($image)value="{{ $article->thumbnail }}"@endif name="thumbnail" id="thumbnail_form">
                </div>
                @error('thumbnail')
                  <div class="text-center text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mt-3">
                  <label for="category">Kategori</label>
                  <select name="category_id" id="category" class="form-control">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                    <div class="text-center text-danger">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="form-group mt-3">
                  <button class="btn btn-primary btn-block">SIMPAN PERUBAHAN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mt-1">Edit Konten</h4>
            </div>
            <div class="card-body">
              @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <textarea name="content" id="summernote">
                {{ $article->content }}
              </textarea>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</section>
{{-- 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#menuTambah">
  Launch demo modal
</button>
 --}}

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
        <form action="{{ route('article') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="title" placeholder="Judul artikel..." class="form-control">
            @error('title')
              <div class="text-small text-danger"></div>
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
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

@include('admin.components.library')

<script>
  let library = new Library();
  library.onChoiced = (r, p) => {
      library.close();
      let image = document.querySelector('#thumbnail_image');
      console.log(image);
      document.querySelector('#thumbnail_image').src = `{{ asset('') }}${r.path}`;
  }

  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
@endsection
  