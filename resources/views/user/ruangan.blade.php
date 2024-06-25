@extends('user.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Custom CSS -->
  <style>
        .wrap-text {
            white-space: normal;
            word-wrap: break-word;
            max-width: 250px; /* Dapat menyesuaikan lebar maksimum sesuai kebutuhan */
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User - Data Ruang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Ruang</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Ruang</h3>

                <!-- Search Manual -->
                <!-- <div class="card-tools">
                  <form action="{{ route('user.ruangan.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ $request->get('search')}}"> 
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="clientside">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ruang</th>
                      <th>Fasilitas</th>
                      <th>Lokasi</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_ruang as $d)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_ruang }}</td>
                        <td>{{ $d->fasilitas }}</td>
                        <td>{{ $d->lokasi }}</td>
                        </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

    <script>
      $(document).ready( function () {
          $('#clientside').DataTable();
      } );
    </script>
@endsection
