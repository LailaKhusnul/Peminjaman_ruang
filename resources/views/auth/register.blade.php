<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ route('register') }}" class="h1"><b>Peminjaman </b>Ruang</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Halaman Register</p>

      <form action="{{ route('register-proses') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama') }}">          
        </div>
        @error('nama')
          <small>{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
          <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">  
        </div>
        @error('email')
          <small>{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
          <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>
        @error('password')
          <small>{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">
          <select name="role_type" class="form-control" required>
            <option value="" selected hidden>Pilih Posisi</option>
            <option value="dosen" {{ old('role_type') == 'dosen' ? 'selected' : '' }}>Dosen</option>
            <option value="mahasiswa" {{ old('role_type') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
          </select>
        </div>
        @error('role_type')
          <small>{{ $message }}</small>
        @enderror
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <!-- /.col -->
        </div>
        <p class="mb-0">
          <br>Sudah Punya Akun?<a href="{{ route('login') }}" class="text-center"> Login</a></br>
        </p>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('success'))
    <script>
        Swal.fire('{{ $message }}');
    </script>
@endif

<!-- Tambahkan kode JavaScript untuk password -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const togglePasswordButton = document.getElementById('togglePassword');
      const togglePasswordIcon = togglePasswordButton.querySelector('i');

      togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle icon class
        togglePasswordIcon.classList.toggle('fa-eye');
        togglePasswordIcon.classList.toggle('fa-eye-slash');
      });
    });
  </script>
</body>
</html>
