@extends('user.main')
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
            <h1 class="m-0">Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Peminjaman</li>
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
        <!-- Filter Data -->
          <!-- <form action="" method="GET" class="form-inline">
            <div class="form-group mb-2">
                <label for="date" class="sr-only">Date</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Select Date" value="{{ request('date') }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="filterType" class="sr-only">Filter Type</label>
                <select class="form-control" id="filterType" name="filterType">
                    <option value="available" {{ request('filterType') == 'available' ? 'selected' : '' }}>Ruangan Kosong</option>
                    <option value="booked" {{ request('filterType') == 'booked' ? 'selected' : '' }}>Ruangan Dipinjam</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
          </form> -->
        <!-- End Filter Data -->
          <div class="col-12">
            <a href="{{ route('peminjamanuser.create') }}" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPeminjamanuserModal">
            Tambah Pinjam
            </a>
            <!-- Modal Tambah Pinjam -->
            <div class="modal fade" id="tambahPeminjamanuserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Form untuk menambah pinjam -->
                    <form action="{{ route('peminjamanuser.store') }}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="id_ruang">Nama Ruang</label>
                        <select name="id_ruang" class="form-control" id="id_ruang">
                          @foreach($data_ruang as $d)
                            <option value="{{ $d->id }}">{{ $d->nama_ruang }}</option>
                          @endforeach
                        </select>
                        @error('nama_ruang')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai Peminjaman</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Pilih Tanggal Mulai Peminjaman">
                        @error('tanggal_mulai')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai Peminjaman</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" placeholder="Pilih Tanggal Selesai Peminjaman">
                        @error('tanggal_selesai')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="kegiatan">Nama Kegiatan</label>
                        <input type="text" name="kegiatan" class="form-control" id="kegiatan" placeholder="Masukkan Nama Kegiatan">
                        @error('kegiatan')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                    <!-- /.modal-body -->
                  </div>
                </div>
              </div>
            </div>
            <!-- End Modal Tambah Pinjam-->
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Peminjaman</h3>

                <!-- Search Manual -->
                <!-- <div class="card-tools">
                  <form action="{{ route('peminjamanuser.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search" value=""> 
  
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
              
              <!-- Tabel Data Peminjaman -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="clientside">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ruang</th>
                      <th>Tanggal & Waktu Peminjaman</th>
                      <th>Tanggal & Waktu Selesai</th>
                      <th>Kegiatan</th>
                      <th>Status</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pinjam as $d)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $d->ruang->nama_ruang}}</td>
                          <td>{{ $d->tanggal_mulai }}</td>
                          <td>{{ $d->tanggal_selesai }}</td>
                          <td>{{ $d->kegiatan }}</td>
                          <!-- <td>{{ $d->status }}</td> -->
                          <!-- Untuk menampilkan kondisi dan juga teks yang lebih user-friendly -->
                          <td>
                            @if($d->status == 'pending')
                              <span class="badge badge-warning">PENDING</span>
                            @elseif($d->status == 'approved')
                              <span class="badge badge-success">APPROVED</span>
                            @elseif($d->status == 'rejected')
                              <span class="badge badge-danger">REJECTED</span>
                            @endif
                          </td>
                          <td>
                            <!-- <a href="{{ route('peminjamanuser.edit',['id' => $d->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a> -->
                            @if($d->status == 'pending')
                            <!-- Tombol untuk menampilkan modal edit -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editPeminjamanUserModal{{ $d->id }}"><i class="fas fa-pen"></i>Edit</button>
                                <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash"></i>Batalkan</a>                           
                            @elseif($d->status == 'approved')
                                <a>Silakan Ambil Slip Peminjaman</a>
                            @elseif($d->status == 'rejected')
                                <a>Pengajuan Peminjaman Ditolak</a>
                            @endif
                          </td>
                        </tr>

                        <!-- Modal Edit Peminjaman User -->
                        <div class="modal fade" id="editPeminjamanUserModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Ruang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <!-- Form untuk mengedit peminjaman user -->
                                <form action="{{ route('ruangan.update',['id' => $d->id]) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <!-- form start -->
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="nama" class="form-control" id="exampleInputEmail1" name="nama" value="{{ $d->nama_ruang }}" placeholder="Enter Nama Ruang">
                                    @error('nama')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fasilitas</label>
                                    <input type="text" name="fasilitas"class="form-control" id="exampleInputEmail1" value="{{ $d->fasilitas }}" placeholder="Enter Fasilitas">
                                    @error('fasilitas')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Lokasi</label>
                                    <input type="text" name="lokasi"class="form-control" id="exampleInputPassword1" value="{{ $d->lokasi }}" placeholder="Lokasi">
                                    @error('lokasi')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- End Modal Edit Peminjaman User -->

                        <div class="modal fade" id="modal-hapus{{ $d->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Batalkan Peminjaman</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Apakah kamu yakin akan membatalkan peminjaman <b>{{ $d->name }}?</b></p>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <form action="{{ route('peminjamanuser.delete',['id' => $d->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-primary">Batalkan</button>

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
          $('#clientside').DataTable();
      } );
    </script>
@endsection
