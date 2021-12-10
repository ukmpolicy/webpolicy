@extends('admin.layouts.index')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Masukan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          {{-- <li class="breadcrumb-item"><a href="#">Anggota</a></li> --}}
          <li class="breadcrumb-item active">Masukan</li>
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
    @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if (session('failed'))<div class="alert alert-danger">{{ session('failed') }}</div>@endif
    @error('reply_content')<div class="alert alert-danger">{{ $message }}</div>@enderror
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>#</td>
              <td>Tanggal</td>
              <td>Name</td>
              <td>Email</td>
              <td>Buka</td>
              <td>Hapus</td>
            </tr>
          </thead>
          <tbody>
            @if ($mails->isEmpty()) 
            <tr>
              <td colspan="7" class="small text-center text-black-50">Tidak ada data.</td>
            </tr>
            @endif
            @foreach ($mails as $mail)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mail->created_at }}</td>
                <td>{{ $mail->name }}</td>
                <td>{{ $mail->email }}</td>
                <td>
                  {{-- <a href="{{ route('mail.detail', ['id' => $mail->id]) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-eye"></i></a> --}}
                  
                  <button class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#content-{{$mail->id}}"><i class="fa fa-eye"></i></button>
                </td>
                <td>
                  <form action="{{ route('mail.destroy', ['id' => $mail->id]) }}" method="post">
                    @csrf @method('delete')
                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Apakah anda yakin ingin menghapus baris ini?')"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              
              <div class="modal fade" id="content-{{$mail->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Konten</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        {{ $mail->content }}
                    </div>
                    <div class="modal-footer justify-content-between">
                        <form action="{{ route('mail.reply', ['id' => $mail->id]) }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="reply_content" class="form-control" placeholder="Ketik balasan">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-reply"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</section>

@section('script')
<script>
</script>
@endsection

@endsection
  