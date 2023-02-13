@extends('admin.layouts.index')

@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
  .card-row {
    box-shadow: none;
  }
  .card-row .card-header {
    padding: 0;
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
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Dokumentasi</li>
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
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-3" style="justify-content: space-between">
          <button class="btn btn-success" data-toggle="modal" data-target="#addEvent"><i class="fa fa-plus mr-2 fa-fw"></i>Tambah Acara</button>
          <form class="d-flex" method="GET" action="">
            <input type="hidden" name="status" value="{{ Request::get('status') }}">
            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" style="width: 300px" placeholder="Cari">
            <div>
              <button class="btn ml-2 btn-primary"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>

        @if (empty($events))
        <div class="py-3 small text-dark-50 text-center" style="border-bottom: 1px solid #ccc;">
          Data Kosong.
        </div>
        @endif

        {{-- List Events --}}
        <div class="accordion" id="accordionExample">
          @foreach ($events as $event)
          <div class="card card-row">

            {{-- Header Event --}}
            <div class="card-header" id="headingOne">
              <div class="row">

                {{-- Event Name --}}
                <div class="col-6 d-flex align-items-center">
                  <h5 class="text-capitalize">
                    {{ $event->name }}
                  </h5>
                </div>

                {{-- Event Bar --}}
                <div class="col-6">
                  <ul class="nav" style="justify-content: right">

                    {{-- Edit Button --}}
                    <a href="" onclick="event.preventDefault();showModal('renameEvent-{{$event->id}}')" class="nav-link text-secondary"><i class="fa fa-edit"></i></a>

                    {{-- Delete Button --}}
                    <form class="d-inline-block" action="{{ route('documentation.destroy.event', ['event_id' => $event->id]) }}" method="post">
                      @csrf @method('delete')
                      <button onclick="return confirm('Apakah anda yakin ingin melakukan hapus')" class="btn btn-link text-secondary d-inline-block">
                        <fa class="fa fa-trash"></fa>
                      </button>
                    </form>

                    {{-- Toggler Button --}}
                    <button class="btn btn-link nav-link text-secondary" type="button" data-toggle="collapse" data-target="#collapse-{{$event->id}}" aria-expanded="true" aria-controls="collapseOne">
                      <i class="fa fa-th"></i>
                    </button>

                  </ul>

                </div>

              </div>

            </div>

            {{-- Inner Event --}}
            <div id="collapse-{{$event->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body px-0 pb-0">

                <div class="row">
                  <div class="col-3">

                    {{-- Button Add Document --}}
                    <div class="card card-item">
                      <div class="card-image" style="cursor: pointer" onclick="library.open('#eventId', {eventId: {{$event->id}}})">
                        <div class="icon"><i class="fa fa-file-upload"></i></div>
                        <input type="hidden" value="" id="eventId">
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-9 d-flex align-items-center">
                            <div class="small">No name...</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  @foreach ($event->getDocumentations() as $doc)

                  <div class="col-3">
                    <div class="card card-item">
                      <div class="card-image showSource">
                        @if ($doc->type == 0)
                          <img src="{{ asset('uploads/'.$doc->path) }}" alt="{{ $doc->description }}" class="image">
                        @elseif ($doc->type == 1)
                          <iframe height="150" class="card-img-top rounded" src="{{ asset($doc->path) }}">
                        </iframe>
                        @endif
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-9 d-flex align-items-center">
                            <div class="small">{{ (strlen($doc->description) > 20) ? substr($doc->description, 0, 20) . '...' : $doc->description }}</div>
                          </div>
                          <div class="col-3">
                            <div class="text-center">
                              
                              <a href="" onclick="event.preventDefault();showModal('renameDocument-{{$doc->id}}')" class="text-secondary small"><i class="fa fa-edit"></i></a>

                              <form class="d-inline-block" action="{{ route('documentation.destroy.documenter', ['event_id' => $event->id,'documenter_id' => $doc->id]) }}" method="post">
                                @csrf @method('delete')
                                <button onclick="return confirm('Apakah anda yakin ingin melakukan hapus')" class="btn p-0 btn-link text-secondary d-inline-block btn-sm ml-2">
                                  <fa class="fa fa-trash"></fa>
                                </button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal fade" id="renameDocument-{{$doc->id}}" tabindex="-1" aria-labelledby="renameDocumentLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="modal-title">Ubah Nama File</div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('documentation.rename.document', ['event_id' => $event->id, 'document_id' => $doc->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                              <input type="text" name="name" placeholder="Nama dokumen..." class="form-control">
                              @error('name')
                                <div class="text-small text-danger">{{ $name }}</div>
                              @enderror
                            </div>
                            <div class="form-group">
                              <button class="btn btn-block btn-primary">UBAH</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>

              </div>
            </div>

          </div>
                  
          <div class="modal fade" id="renameEvent-{{$event->id}}" tabindex="-1" aria-labelledby="renameEventLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title">Ubah Nama File</div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('documentation.rename.event', ['event_id' => $event->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <input type="text" name="name" placeholder="Nama acara..." class="form-control">
                      @error('name')
                        <div class="text-small text-danger">{{ $name }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <button class="btn btn-block btn-primary">UBAH</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>

</section> 

<div class="modal fade" id="menuTambah" tabindex="-1" aria-labelledby="menuTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Apa yang ingin ditambahkan?</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <button class="btn  btn-block btn-sm btn-primary" data-dismiss="modal" type="button" data-toggle="modal" data-target="#addEvent">
              ACARA
            </button>
          </div>
          <div class="col-6">
            <a href="" class="btn btn-primary btn-block btn-sm">DOKUMENTER</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah Acara</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('documentation.store.event') }}" method="post">
          @csrf
          <div class="form-group">
            <input type="text" name="name" placeholder="Nama acara..." class="form-control">
            @error('name')
              <div class="text-small text-danger">{{ $name }}</div>
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
  modal = null;
  function showModal(id) {
    if (modal) modal.hide();
    let el = document.getElementById(id);
    if (el)  {
      modal = new bootstrap.Modal(el, {
        keyboard: false
      })
      modal.show();
    }
  }

  let fd = new FormData();
  fd.append('source_id', 1);
  fd.append('description', 'aa');
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
  