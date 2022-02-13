@extends('admin.layouts.index')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/library.css') }}">
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
                <div class="card" style="box-shadow: none;border:none;">
                    <div class="source_view" onclick="library.choiceType()" id="buttonExplore">
                        <div class="text-black-50"><i class="fa fa-file-upload"></i></div>
                        <div class="loading" style="margin-left: 0%; display: none;"><i class="fa fa-spinner"></i></div>
                        <input type="file" class="d-none file_browse">
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
                    <iframe height="150" class="card-img-top rounded" src="{{ asset($source->path) }}">
                    </iframe>
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
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/Library.js') }}"></script>
<script>
  let user_id = '';
  @if (auth()->check())
  user_id = parseInt('{{ auth()->user()->id }}');
  @endif
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