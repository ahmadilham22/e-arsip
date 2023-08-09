@extends('layouts.app')

@section('title')
    Edit Data Mahasiswa
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="" class="form-control"
                                        value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">NPM</label>
                                    <input type="text" name="npm" id="" class="form-control"
                                        value="{{ $data->npm }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Roles</label>
                                    <select name="role" id="" required class="form-control">
                                        <option value="{{ $data->role }}">Tidak Ganti</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                    {{-- <small>Kosongkan jika tidak ingin diganti</small> --}}
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
@endsection
