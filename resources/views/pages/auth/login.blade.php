<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ asset('assets/image/Logo_UnivLampung.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.css') }}">
    <style>
        .my-sweetalert-container {
            z-index: 9999;
            /* Atur z-index yang lebih tinggi daripada elemen lain */
            /* Tambahkan gaya lain yang diperlukan */
        }
    </style>
</head>

<body>
    <div class="hold-transition login-page">
        {{-- @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="login-box" style="z-index: 1">
            <div class="login-logo">
                <a href=""><b>Teknik Informatika - Universitas Lampung</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('signin') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="npm" class="form-control" placeholder="Npm">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-success btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.login-box -->
    </div>
    <!-- jQuery -->

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sampai Jumpa',
                text: '{{ session('success') }}',
                showConfirmButton: true, // Menyembunyikan tombol OK
                timer: 3000, // Menetapkan waktu (dalam milidetik) sebelum SweetAlert otomatis menghilang
            });
        @endif
    </script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Login Gagal',
                text: '{{ $errors->first() }}',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
</body>

</html>
