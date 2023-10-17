@extends('layouts.app')

@section('arrow')
    <a href="{{ route('user.list') }}" class="text-dark"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    {{-- <a href="javascript:history.back()" class="text-dark">
        <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a> --}}
@endsection

@section('title')
    Tambah Data User
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" id="" class="form-control"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">NPM</label>
                                        <input type="text" name="npm" id="" class="form-control"
                                            value="{{ old('npm') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Angkatan</label>
                                        <input type="text" name="angkatan" id="" class="form-control"
                                            value="{{ old('angkatan') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Roles</label>
                                        <select name="role" id="" class="form-control">
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ $errors->first() }}',
                showConfirmButton: true,
                timer: 5000,
            });
        </script>
    @endif
@endpush
