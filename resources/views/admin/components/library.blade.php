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
                        <div class="source_view" onclick="library.browse()" id="buttonExplore">
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
                            <video src="{{ asset($source->path) }}" style="height: 150px;" class="card-img-top rounded"></video>
                            @endif

                            @if ($source->type == 0)
                            <img src="{{ asset($source->path) }}" style="height: 150px;object-fit: cover;" class="card-img-top rounded" alt="{{ $source->description }}">
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

<script>
    let user_id = '';
    @if (auth()->check())
    user_id = parseInt('{{ auth()->user()->id }}');
    @endif
</script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/Library.js') }}"></script>