@extends('admin.layouts.index')

@section('style')
<!-- summernote -->
{{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="//bootswatch.com/3/darkly/bootstrap.css"> --}}
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
        <h1 class="m-0">Ubah Data Artikel</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('article') }}">Daftar Artikel</a></li>
          <li class="breadcrumb-item active">{{ $article->slug }}</li>
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
        <div class="col-lg-8 col-12">
          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @elseif (session('failed'))
          <div class="alert alert-danger">
            {{ session('failed') }}
          </div>
          @endif

          @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          {{-- Editor --}}

          <div class="text-center small text-black-50 mt-5 pt-5" id="waiteditor">Please Wait...</div>
          <textarea name="content" class="d-none" id="summernote">
            {{ $article->content }}
          </textarea>

          {{-- <div id="editor"></div> --}}


          {{-- End Editor --}}
        </div>
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
                  @if ($image)
                  <img src="{{ asset('/uploads/library/'.$image->path) }}" id="thumbnail_image" alt="{{ $image->description }}">
                  @endif
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
      </div>
    </form>
  </div>

</section>

@endsection

@section('script')
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>
<!-- Summernote -->
{{-- <script src="../../plugins/summernote/summernote-bs4.min.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> --}}


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
    document.querySelector('#waiteditor').classList.add('d-none')
    document.querySelector('#summernote').classList.remove('d-none')
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        // codemirror: { "theme": "ambiance" }
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          // ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
          onPaste: function (e) {
            alert('a')
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
            e.preventDefault();
            var div = $('<div />');
            div.append(bufferText);
            div.find('*').removeAttr('style');
            setTimeout(function () {
              document.execCommand('insertHtml', false, div.html());
            }, 10);
          }
        }
    })

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
@endsection
  