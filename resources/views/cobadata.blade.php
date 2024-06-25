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
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
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
            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahUserModal">
            Tambah Data
            </a>

            <!-- Modal Tambah User -->
            <div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Form untuk menambah user -->
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data"> 
                      @csrf   
                      <div class="form-group">
                        <label for="exampleInputEmail1">Photo Profile</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="photo">
                        @error('photo')
                          <small>{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                        @error('email')
                          <small>{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama"class="form-control" id="exampleInputEmail1" placeholder="Enter Nama">
                        @error('nama')
                          <small>{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password"class="form-control" id="exampleInputPassword1" placeholder="Password">
                        @error('password')
                          <small>{{ $message }}</small>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Posisi</label>
                        <select name="role_type" class="form-control" required>
                          <option value="">Pilih Posisi</option>
                          <option value="dosen" {{ old('role_type') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                          <option value="mahasiswa" {{ old('role_type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                      </div>
                      @error('role_type')
                        <small>{{ $message }}</small>
                      @enderror
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Modal Tambah User -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>

                <!-- Search Manual -->
                <!-- <div class="card-tools">
                  <form action="{{ route('index') }}" method="GET">
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
                <table class="table table-hover text-nowrap" id="serverside">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Photo</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $d)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                        @if($d->image)
                            <img src="{{ asset('storage/photo-user/'.$d->image) }}" alt="" width="100">
                        @else
                            <img src="{{ asset('images/default-user.png') }}" alt="" width="100">
                        @endif
                        </td>
                        <!-- <td><img src="{{ asset('storage/photo-user/'.$d->image) }}" alt="" width="100" ></td> -->
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->email }}</td>
                        <td>{{ ucfirst($d->role_type) }}</td>
                        <td>
                            <!-- Tombol untuk menampilkan modal edit -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editUserModal{{ $d->id }}"><i class="fas fa-pen"></i>Edit</button>
                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>                           
                        </td>
                        </tr>

                        <!-- Modal Edit User -->
                        <div class="modal fade" id="editUserModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Ruang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <!-- Form untuk mengedit user -->
                                <form action="{{ route('user.update', ['id' => $d->id]) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $d->email }}" placeholder="Enter email">
                                    @error('email')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" name="nama"class="form-control" id="exampleInputEmail1" value="{{ $d->name }}" placeholder="Enter Nama">
                                    @error('nama')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password"class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    @error('password')
                                      <small>{{ $message }}</small>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label>Posisi</label>
                                    <select name="role_type" class="form-control" required>
                                      <option value="">Pilih Posisi</option>
                                      <option value="dosen" {{ old('role_type') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                      <option value="mahasiswa" {{ old('role_type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                  </div>
                                  @error('role_type')
                                    <small>{{ $message }}</small>
                                  @enderror
                                <div class="card-footer">
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
                                <form action="{{ route('user.delete',['id' => $d->id]) }}" method="POST">
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
