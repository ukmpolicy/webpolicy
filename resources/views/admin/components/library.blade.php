@php
    $sources = [];
    if (auth()->check()) {
        // dd('a');
        $sources = DB::table('sources')->where('author_id', auth()->user()->id)->get()->reverse();
    }
    // dd($sources);
@endphp
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/library.css') }}">
<div id="libraryLayout">
    <div class="container">
        <div class="card">
            <div class="card-header library-header">
                <h3 class="card-title mt-1">Pustaka</h3>

                <div class="card-tools mr-1 mt-1" style="margin-left: 2rem">
                    <a class="text-secondary" style="cursor: pointer" onclick="library.close()"><i class="fa fa-times"></i></a>
                </div>  

                <div class="card-tools ml-3 mt-1 search">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                        </div>
                    </div> 
                </div>  

            </div>
            <div class="card-body">
                <div class="row">

                {{-- Brose Button --}}
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
                        <div class="card" style="box-shadow: none;border:none;">

                            @if ($source->type == 1)                            
                            <iframe height="150" class="card-img-top rounded" src="{{ $source->path }}">
                            </iframe>
                            @endif

                            @if ($source->type == 0)
                            <img src="{{ asset('uploads/library/'.$source->path) }}" style="height: 150px;object-fit: cover;" class="card-img-top rounded" alt="{{ $source->description }}">
                            @endif

                            <div class="card-body p-1 rounded mt-2" style="border: 1px solid #eaeaea">
                                <div class="row">
                                    <div class="col-10">
                                    <span class="ml-2 text-black-50 small" style="">{{ (strlen($source->description) > 20) ? substr($source->description, 0, 20) . '...' : $source->description }}</span>
                                    </div>
                                    <div class="col-2 choice-button text-black-50" onclick="library.choiceSource({{$source->id}})" style="cursor: pointer">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="typeFile" tabindex="-1" aria-labelledby="typeFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Tipe File?</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <button class="btn btn-primary btn-block" onclick="library.browseImage()"><i class="fa fa-image"></i></button>
            </div>
            <div class="col-6">
              <button class="btn btn-primary btn-block" onclick="library.browseVideo()"><i class="fa fa-video"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="browseVideo" tabindex="-1" aria-labelledby="browseVideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Tambah Video Dokumentasi</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('source.store.video') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="url" placeholder="Youtube url..." class="form-control">
              @error('url')
                <div class="text-small text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" name="description" placeholder="Descripsi..." class="form-control">
              @error('description')
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
<script>
    let user_id = '';
    @if (auth()->check())
    user_id = parseInt('{{ auth()->user()->id }}');
    @endif
</script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/Library.js') }}"></script>