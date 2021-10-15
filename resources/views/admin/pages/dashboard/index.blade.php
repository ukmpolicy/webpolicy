@extends('admin.layouts.index')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/chart.js/Chart.min.css') }}">
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
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Pendaftar</h3>
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
            <div class="chart">
              <canvas id="registrant" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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

<script>
  let ctx = document.querySelector('#registrant').getContext('2d');
  var registrant = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [4,5,6,7,8,9,10,11,12,13,14],
        datasets: [{
            label: 'Net sales',
            data: [4,5,6,7,8,9,10,11,12,13,14],
            parsing: {
                yAxisKey: 'net'
            }
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  });
</script>
{{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
@endsection