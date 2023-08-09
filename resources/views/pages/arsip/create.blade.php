@extends('layouts.app')

@section('title')
    Tambah Data Arsip
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
                    <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Judul</label>
                                    <input type="text" name="judul" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Ruang</label>
                                    <input type="text" name="ruang" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Jenis Laporan</label>
                                    <select name="jenis_laporan" id="" class="form-control">
                                        <option value="Skripsi">Skripsi</option>
                                        <option value="Kp">Kerja Praktek</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Pemilik</label>
                                    <select name="user_id" id="" required class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Dosen Pembimbing 1</label>
                                    <select name="dosen_pembimbing_1" id="" required class="form-control">
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Dosen Pembimbing 2</label>
                                    <select name="dosen_pembimbing_2" id="" required class="form-control">
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Dosen Penguji</label>
                                    <select name="dosen_penguji" id="" required class="form-control">
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dokumen</label>
                                    <input type="file" name="dokumen" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tanggal Seminar</label>
                                    <input type="date" name="tgl_seminar" id="" class="form-control" required>
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
