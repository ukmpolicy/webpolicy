@extends('admin.layouts.index')

@section('style')
<!-- summernote -->
{{-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="//bootswatch.com/3/darkly/bootstrap.css"> --}}
<style>
  /* #thumbnail {
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
  } */
  .loading {
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,.75);
      z-index: 100;
      display: none;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: #fff;
      text-align: center;
      padding: 0 1rem;
  }
/*  */

.choice-file {
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
  .choice-file img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  .choice-file .label {
    left: .2rem;
    top: .2rem;
    right: .2rem;
    bottom: .2rem;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    transition: .3s;
    border-radius: 4px;
    position: absolute;
    align-items: center;
    justify-content: center;
  }

  .choice-file .success .label {
    opacity: 0;
  }
  
  .choice-file .success:hover .label {
    background-color: rgba(0,0,0,.5);
    color: #fff;
    opacity: 1;
  }

/*  */
  .loading img {
      height: 100px;
  }
  .loading.show {
      display: flex;
  }
</style>
@endsection

@section('content')
<div class="loading">
    <img src="{{ asset('images/loading.gif') }}" alt="Loading Pinguin">
    <p class="small">Sedang menyimpan, mohon tunggu sejenak...</p>
    {{-- <img src="{{ asset('images/loading2.gif') }}" alt="Loading"> --}}
</div>
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
    <form action="{{ route('article.update', ['id' => $article->id]) }}" method="post" enctype="multipart/form-data">
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
                <div class="form-group">
                  <label for="title">Judul</label>
                  <input type="text" name="title" value="{{ $article->title }}" id="title" placeholder="Judul" class="form-control">
                  @error('title')
                    <div class="text-center text-danger">{{ $message }}</div>
                  @enderror
                </div>
  
                {{-- <label>Thumbnail</label>
                <div id="thumbnail" onclick="library.open('#thumbnail_form')">
                  @if ($image)
                  <img src="{{ asset('/uploads/library/'.$image->path) }}" id="thumbnail_image" alt="{{ $image->description }}">
                  @endif
                  <div class="label"><i class="fa fa-edit"></i></div>
                  <input type="hidden" @if ($image)value="{{ $article->thumbnail }}"@endif name="thumbnail" id="thumbnail_form">
                </div>
                @error('thumbnail')
                  <div class="text-center text-danger">{{ $message }}</div>
                @enderror --}}
                
              {{-- Photo --}}
              <div class="choice-file" id="thumbnail" onclick="choiceFile('thumbnail')">
                @if ($article->thumbnail)
                  <img src="{{ asset('uploads/'.$article->thumbnail) }}" id="thumbnail" alt="{{ $article->title }}">
                @endif
                
                <div class="normal">
                  <div class="label">
                    <div class=""><i class="fa fa-edit"></i></div>
                    <b>Tap to upload</b>
                  </div>
                </div>
                <div class="success">
                  <div class="label">
                    <div class=""><i class="fa fa-edit"></i></div>
                    <b>Tap to change</b>
                  </div>
                </div>

                <input type="file" class="d-none file-selector" value="" name="thumbnail">
                <input type="hidden" class="file-value" name="thumbnail-value" value="{{ $article->thumbnail }}">
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
                  <button onclick="showLoading()" class="btn btn-primary btn-block">SIMPAN PERUBAHAN</button>
                </div>
                
                <div class="form-group mt-3">
                  <a href="{{ route('article.view', ['slug' => $article->slug]) }}" onclick="showLoading()" class="btn btn-primary btn-block">TAMPILKAN</a>
                </div>
              
              </form>
              <div class="form-group mt-3">
                <form action="{{ route('article.switch_status', ['id' => $article->id]) }}" method="post">
                  @csrf
                  <button class="btn btn-primary btn-block" onclick="showLoading()">
                    {{ ($article->is_public) ? 'Batal Publikasi' : 'Publikasikan' }}
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
  
  function showLoading() {
      $('.loading').addClass('show');
  }

  function checkFileInputs() {
      let inps = document.querySelectorAll('.choice-file');
      inps.forEach(function(inp) {
          let id = $(inp).attr('id');
          let input = document.querySelector('#' + id + ' .file-value');

          if (input.value.trim().length > 0) {
              document.querySelector('#' + id + ' .normal').style.display = 'none';
              document.querySelector('#' + id + ' .success').style.display = 'block';
          }else {
              document.querySelector('#' + id + ' .normal').style.display = 'block';
              document.querySelector('#' + id + ' .success').style.display = 'none';
          }
      })
  }

  checkFileInputs();
  
  function choiceFile(id) {
    document.querySelector('#'+ id +' .file-selector').onchange = function() {
        let id = $(this.parentNode).attr('id');
        document.querySelector('#' + id + ' .file-value').value = true;
        checkFileInputs();
    }
    document.querySelector('#' + id + ' .file-selector').click();
      // checkFileInputs();
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
  