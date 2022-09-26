@extends('admin.layouts.index')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/chart.js/Chart.min.css') }}">
<style>
  .moon-grid {
    display: grid;
    grid-template-columns: 16px 16px 16px 16px;
    gap: 6px;
  }
  .day-box {
    width: 16px;
    height: 16px;
    font-size: 8px;
    background-color: #ccc;
    border-radius: 2px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .day-box:hover {
    background-color: #aaa;
  }
  .day-box.active {
    color: #fff;
    background-color: royalblue;
  }
  .day-box.active:hover {
    background-color: rgb(69, 102, 202);
  }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
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

      <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kalender Ulang Tahun</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button> --}}
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              @for ($i = 0; $i < 12; $i++)
                <div class="col-1">
                  <h6 class="text-capitalize">{{  $moons[$i]  }}</h6>
                  <div class="moon-grid">
                    @for ($i2 = 0; $i2 < 32; $i2++)
                      @if (count($mbd[$i][$i2]) > 0 )
                      <div class="day-box active"  data-toggle="tooltip" data-placement="top" title="">{{  $i2+1  }}</div>
                      @else
                      <div class="day-box">{{  $i2+1  }}</div>
                      @endif
                    @endfor
                  </div>
                </div>
              @endfor
            </div>
          </div>
            <!-- /.card-body -->
        </div>
      </div>

    </div>
  </div>
</section>
<!-- /.content -->

@endsection
  
@section('script')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>

<script>
axios.get('/api/members-born-date')
  .then((res) => {
    console.log(res);
  })
</script>
{{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
@endsection