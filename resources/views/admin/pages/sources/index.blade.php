@extends('admin.layouts.index')

@section('style')
<style>
  .library-button-explore {
    height: 150px !important;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ddd;
    background-size: cover;
    background-position: center center;
    cursor: pointer;
  }
  .library-button-explore .loading {
    top: 0;
    bottom: 0;
    transition: 1s;
    left: 0;
    right: 0;
    background-color: rgba(65, 119, 218, 0.1);
    backdrop-filter: blur(5px);
    position: absolute;
  }
</style>
@endsection

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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{-- <h3 class="card-title mt-1">Bordered Table</h3> --}}
            
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
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">

              <div class="col-lg-3 col-md-4 col-6">
                <div class="card" style="box-shadow: none;">
                  <div class="text-center rounded library-button-explore" id="buttonExplore">
                    <div class="text-black-50"><i class="fa fa-file-upload"></i></div>
                    <div class="loading" style="margin-left: 0%; display: none;"></div>
                    <input type="file" name="file_source" class="d-none" id="file_source">
                  </div>
                  <div class="card-body p-1 rounded mt-2" style="border: 1px solid #eaeaea">
                    <div class="row">
                      <div class="col-10">
                        <span class="ml-2 text-black-50 small" id="file_source_label">Belom ada file...</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              @foreach ($sources as $source)
                <div class="col-lg-3 col-md-4 col-6">
                  <div class="card" style="box-shadow: none;">

                    @if ($source->type == 1)
                    <video src="{{ asset($source->path) }}" style="height: 150px;" class="card-img-top rounded"></video>
                    @endif

                    @if ($source->type == 0)
                    <img src="{{ asset($source->path) }}" style="height: 150px;object-fit: cover;" class="card-img-top rounded" alt="{{ $source->description }}">
                    @endif

                    <div class="card-body p-1 rounded mt-2" style="border: 1px solid #eaeaea">
                      <div class="row">
                        <div class="col-10">
                          <span class="ml-2 text-black-50 small">{{ (strlen($source->description) > 20) ? substr($source->description, 0, 20) . '...' : $source->description }}</span>
                        </div>
                        <div class="col-2 text-center text-black-50">
                          <form action="{{ route('library.delete', ['id' => $source->id]) }}" id="df_{{$source->id}}" method="post">@csrf @method('delete')</form>
                          <a href="#" onclick="deleteSource('df_{{$source->id}}','{{$source->description}}')" class="text-danger"><i class="fa fa-trash"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

</section>

@endsection

@section('script') 
{{-- Vue JS --}}
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>

<script>
  function deleteSource(id,desc) {
    event.preventDefault();
    let conf = confirm('Apakah anda yakin ingin menghapus file '+desc);
    if (conf) {
      document.querySelector('#'+id).submit();
    }
  }
  $('#buttonExplore').click(function() {
    document.querySelector('#file_source').click();
  })
  $('#file_source').change(function(e) {
    
    document.querySelector('#buttonExplore').style.backgroundImage = `url('${URL.createObjectURL(this.files[0])}')`;

    let fd = new FormData();
    let file = this.files[0];
    fd.append('file_source', file);
    
    fd.append('user_id', parseInt('{{ auth()->user()->id }}'));
    axios.post('/api/source/upload', fd, {
      onUploadProgress: (progressEvent) => {
        const totalLength = progressEvent.lengthComputable ? progressEvent.total : progressEvent.target.getResponseHeader('content-length') || progressEvent.target.getResponseHeader('x-decompressed-content-length');
        // console.log("onUploadProgress", totalLength);
        if (totalLength !== null) {
          let el = document.querySelector('#buttonExplore .loading');
          document.querySelector('#file_source_label').innerHTML = file.name;
          el.style.display = 'block';
          el.style.transition = `1s`;
          el.style.marginLeft = `${Math.round( (progressEvent.loaded * 100) / totalLength )}%`;
          if (el.style.marginLeft == '100%') {
            setTimeout(() => {
              el.style.display = 'none';
              el.style.marginLeft = `0%`;
            }, 2000)
          }
        }
      }
    })
    .then(r => {
      console.log(r);
      location.reload();
    })
    .catch(e => {
      console.dir(e);
    })
  })
</script>

@endsection