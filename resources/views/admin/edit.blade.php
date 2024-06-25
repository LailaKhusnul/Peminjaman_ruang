@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ruang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Ruang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="{{ route('ruangan.update',['id' => $data_ruang->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Form Tambah Ruang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="nama" class="form-control" id="exampleInputEmail1" name="nama" value="{{ $data_ruang->nama_ruang }}" placeholder="Enter Nama Ruang">
                      @error('nama')
                        <small>{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fasilitas</label>
                      <input type="text" name="fasilitas"class="form-control" id="exampleInputEmail1" value="{{ $data_ruang->fasilitas }}" placeholder="Enter Fasilitas">
                      @error('fasilitas')
                        <small>{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Lokasi</label>
                      <input type="text" name="lokasi"class="form-control" id="exampleInputPassword1" value="{{ $data_ruang->lokasi }}" placeholder="Lokasi">
                      @error('lokasi')
                        <small>{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
        </form>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
