@extends('layouts.app')

@section('arrow')
    <a href="{{ route('arsip.list') }}" class="text-dark"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    {{-- <a href="javascript:history.back()" class="text-dark">
        <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a> --}}
@endsection

@section('title')
    Edit Data Arsip
@endsection


@section('content')
    <div class="row w-100">
        <div class="container-fluid w-100">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Judul</label>
                                        <input type="text" name="judul" value="{{ $arsip->judul }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Ruang</label>
                                        <input type="text" name="ruang" id="" class="form-control"
                                            value="{{ $arsip->ruang }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Jenis Laporan</label>
                                        <select name="jenis_laporan" id="" class="form-control">
                                            <option value="Skripsi">Skripsi</option>
                                            <option value="Kerja Praktek">Kerja Praktek</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Pemilik</label>
                                        <select name="user_id" id="" class="form-control">
                                            {{-- @if (Auth::user()->role == 'mahasiswa')
                                                disabled
                                            @endif> --}}
                                            @if (Auth::user()->role == 'mahasiswa')
                                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                            @else
                                                <option value="">Pilih Opsi...</option>
                                                @foreach ($users as $user)
                                                    {{-- <option value="{{ $user->id }}">{{ Auth::user()->name }}</option> --}}
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dosen Pembimbing 1</label>
                                        <select name="dosen_pembimbing_1" id="" class="form-control">
                                            <option value="">Pilih Opsi...</option>
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dosen Pembimbing 2</label>
                                        <select name="dosen_pembimbing_2" id="" class="form-control">
                                            <option value="">Pilih Opsi...</option>
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dosen Pembahas</label>
                                        <select name="dosen_penguji" id="" class="form-control">
                                            <option value="">Pilih Opsi...</option>
                                            @foreach ($dosens as $dosen)
                                                <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dokumen</label>
                                        <input type="file" name="dokumen" id="" value="{{ $arsip->dokumen }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Berita Acara</label>
                                        <input type="file" name="berita_acara" id=""
                                            value="{{ $arsip->berita_acara }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tanggal Seminar</label>
                                        <input type="date" name="tgl_seminar" id=""
                                            value="{{ $arsip->tgl_seminar }}" class="form-control">
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
