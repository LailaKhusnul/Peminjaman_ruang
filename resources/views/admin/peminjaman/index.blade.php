@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin-Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Peminjaman</li>
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
          <a href="{{ route('peminjaman.index') }}?export=pdf" class="btn btn-danger mb-3">Export Pdf</a>
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Peminjaman</h3>

                <!-- Search Manual -->
                <!-- <div class="card-tools">
                  <form action="{{ route('peminjaman.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                <table class="table table-hover text-nowrap" id="serverside">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Peminjam</th>
                      <th>Nama Ruang</th>
                      <th>Tanggal Peminjaman</th>
                      <th>Tanggal Selesai</th>
                      <th>Kegiatan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pinjam as $d)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $d->user?->name}}</td>
                          <td>{{ $d->ruang->nama_ruang}}</td>
                          <td>{{ $d->tanggal_mulai }}</td>
                          <td>{{ $d->tanggal_selesai }}</td>
                          <td>{{ $d->kegiatan }}</td>
                          <td>{{ $d->status }}</td>
                          <td>
                            @if($d->status == 'pending')
                              <form action="{{ route('peminjaman.approve', $d->id) }}" method="POST" style="display:inline-block;">
                                  @csrf
                                  @method('PUT')
                                  <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                              </form>
                              <form action="{{ route('peminjaman.reject', $d->id) }}" method="POST" style="display:inline-block;">
                                  @csrf
                                  @method('PUT')
                                  <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                              </form>
                            @endif
                          </td>
                          <td>
                              <!-- <a href="{{ route('ruangan.edit',['id' => $d->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a> -->
                            @if($d->status == 'pending')
                              <!-- Tombol untuk menampilkan modal edit -->
                              <button class="btn btn-primary" data-toggle="modal" data-target="#editPeminjamanModal{{ $d->id }}"><i class="fas fa-pen"></i>Edit</button>
                              <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>                           
                            @endif
                            </td>
                        </tr>

                        <!-- Modal Edit Ruang -->
                        <div class="modal fade" id="editPeminjamanModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Ruang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <!-- Form untuk mengedit ruangan -->
                                <form action="{{ route('ruangan.update', ['id' => $d->id]) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="form-group">
                                    <label for="nama">Nama Ruang</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="{{ $d->nama_ruang }}">
                                    @error('nama')
                                        <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="fasilitas">Fasilitas</label>
                                    <input type="text" class="form-control" id="fasilitas" name="fasilitas" value="{{ $d->fasilitas }}">
                                    @error('fasilitas')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control" id="lokasi" value="{{ $d->lokasi }}">
                                    @error('lokasi')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Modal Edit Ruang -->

                        <div class="modal fade" id="modal-hapus{{ $d->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah kamu yakin akan menghapus data <b>{{ $d->name }}?</b></p>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <form action="{{ route('ruangan.delete',['id' => $d->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Hapus Data</button>

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
        $('#serverside').DataTable();
      } ); 
    </script>
@endsection