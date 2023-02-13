@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Jabatan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Jabatan</li>
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
    @endif
    @if (session('failed'))
    <div class="alert alert-danger">
      {{ session('failed') }}
    </div>
    @endif
    <div class="card">
      <div class="card-header" style="height: fit-content">
        <div class="row">
          <div class="col-6">
            <form action="" id="filter_period">
              <select name="period" onchange="document.querySelector('#filter_period').submit()" class="form-control" style="width: fit-content">
                @foreach ($periods as $period)
                  <option @if ($period->id == Request::get('period') || $period->id == $period_active->id) selected @endif value="{{ $period->id }}">Periode {{ $period->name }}</option>
                @endforeach
              </select>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered" style="width: 100%">
          <thead>
            <tr>
              <td>#</td>
              <td>Nama</td>
              <td>Periode</td>
              <td>Edit</td>
              <td>Hapus</td>
            </tr>
            <tr>
              <td colspan="5">
                <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modalAddPosition"><i class="fa fa-plus"></i></button>
              </td>
            </tr>
          </thead>
          <tbody>
            @foreach ($positions as $position)
              <tr>
                <td style="width: 8%;text-center;">
                  <div class="d-flex" style="gap: 0.5rem">
                    <form class="w-100" action="{{ route('position.moveup', ['id' => $position->id]) }}" method="post">
                      @csrf
                      <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-angle-up"></i></button>
                    </form>
                    <form class="w-100" action="{{ route('position.movedown', ['id' => $position->id]) }}" method="post">
                      @csrf
                      <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-angle-down"></i></button>
                    </form>
                  </div>
                </td>
                <td style="font-size: 21px;text-transform: capitalize;">{{ $position->name }}</td>
                <td style="font-size: 21px;text-transform: capitalize;">{{ $position->period }}</td>
                <td>
                  <button class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalEditPosition{{$position->id}}"><i class="fa fa-edit"></i></button>

                  <div class="modal fade" id="modalEditPosition{{$position->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Jabatan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('position.update', ['id' => $position->id]) }}" method="post">
                            @method('put')
                            @csrf

                            <div class="form-group">
                              <label for="name">Nama:</label>
                              <input type="text" id="name" name="name" value="{{ $position->name }}" class="form-control">
                              @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                              <label for="name">Periode:</label>
                              {{-- <input type="text" id="name" name="name" class="form-control"> --}}
                              <select class="form-control" name="period_id">
                                @foreach ($periods as $period)
                                  <option value="{{ $period->id }}" @if ($period->id == $position->period_id) selected @endif>{{ $period->name }}</option>
                                @endforeach
                              </select>
                              @error('period_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                              <label for="name">Bidang:</label>
                              {{-- <input type="text" id="name" name="name" class="form-control"> --}}
                              <select class="form-control" name="division_id">
                                <option value="">tidak ada bidang</option>
                                @foreach ($divisions as $division)
                                  <option value="{{ $division->id }}" @if ($division->id == $position->division_id) selected @endif>{{ $division->name }}</option>
                                @endforeach
                              </select>
                              @error('division_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group" style="gap: 1rem; display: flex;">
                              <input type="checkbox" name="in_division" @if ($position->sub_in_position_id) checked @endif>
                              Anggota Bidang?
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                          <button type="submit" class="btn btn-primary">Ubah</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                </td>
                <td>
                  {{-- <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button> --}}
                  <form action="{{ route('position.destroy', ['id' => $position->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @foreach ($position->members as $position2)
                <tr class="bg-light">
                  <td style="width: 8%;text-center;">
                    <div class="d-flex" style="gap: 0.5rem">
                      <form class="w-100" action="{{ route('position.moveup', ['id' => $position2->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="subof" value="{{ $position->id }}">
                        <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-angle-up"></i></button>
                      </form>
                      <form class="w-100" action="{{ route('position.movedown', ['id' => $position2->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="subof" value="{{ $position->id }}">
                        <button class="btn btn-block btn-primary btn-sm"><i class="fa fa-angle-down"></i></button>
                      </form>
                    </div>
                  </td>
                  <td style="font-size: 21px;text-transform: capitalize;">{{ $position2->name }}</td>
                  <td style="font-size: 21px;text-transform: capitalize;">{{ $position2->period }}</td>
                  <td>
                    <button class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalEditPosition{{$position2->id}}"><i class="fa fa-edit"></i></button>

                    <div class="modal fade" id="modalEditPosition{{$position2->id}}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Jabatan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('position.update', ['id' => $position2->id]) }}" method="post">
                              @method('put')
                              @csrf

                              <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" id="name" name="name" value="{{ $position2->name }}" class="form-control">
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                              </div>

                              <div class="form-group">
                                <label for="name">Periode:</label>
                                {{-- <input type="text" id="name" name="name" class="form-control"> --}}
                                <select class="form-control" name="period_id">
                                  @foreach ($periods as $period)
                                    <option value="{{ $period->id }}" @if ($period->id == $position2->period_id) selected @endif>{{ $period->name }}</option>
                                  @endforeach
                                </select>
                                @error('period_id') <div class="text-danger">{{ $message }}</div> @enderror
                              </div>

                              <div class="form-group">
                                <label for="name">Bidang:</label>
                                {{-- <input type="text" id="name" name="name" class="form-control"> --}}
                                <select class="form-control" name="division_id">
                                  <option value="">tidak ada bidang</option>
                                  @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" @if ($division->id == $position2->division_id) selected @endif>{{ $division->name }}</option>
                                  @endforeach
                                </select>
                                @error('division_id') <div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                              <div class="form-group" style="gap: 1rem; display: flex;">
                                <input type="checkbox" name="in_division" @if ($position2->sub_in_position_id) checked @endif>
                                Anggota Bidang?
                              </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                  </td>
                  <td>
                    {{-- <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button> --}}
                    <form action="{{ route('position.destroy', ['id' => $position2->id]) }}" method="post">
                      @csrf @method('delete')
                      <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->

<div class="modal fade" id="modalAddPosition">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Jabatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('position.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" class="form-control">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="name">Periode:</label>
            {{-- <input type="text" id="name" name="name" class="form-control"> --}}
            <select class="form-control" name="period_id">
              @foreach ($periods as $period)
                <option value="{{ $period->id }}">{{ $period->name }}</option>
              @endforeach
            </select>
            @error('period_id') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="name">Bidang:</label>
            {{-- <input type="text" id="name" name="name" class="form-control"> --}}
            <select class="form-control" name="division_id">
                <option value="">tidak ada bidang</option>
                @foreach ($divisions as $division)
                  <option class="text-capitalize" value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
            @error('division_id') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
          <div class="form-group" style="gap: 1rem; display: flex;">
            <input type="checkbox" name="in_division">
            Anggota Bidang?
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@section('script')
<script>
  // document.querySelector('#add_division').onchange = (e) => {
  //   if (e.target.value) {
  //     document.querySelector('#in_add_division').style.display = 'flex';
  //   }else {
  //     document.querySelector('#in_add_division').style.display = 'none';
  //   }
  // }
  // document.querySelector('#edit_division').onchange = (e) => {
  //   if (e.target.value) {
  //     document.querySelector('#in_edit_division').style.display = 'flex';
  //   }else {
  //     document.querySelector('#in_edit_division').style.display = 'none';
  //   }
  // }
</script>
@endsection

@endsection
  