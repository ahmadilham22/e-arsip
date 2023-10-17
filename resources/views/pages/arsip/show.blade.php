@extends('layouts.app')

@section('arrow')
    <a href="javascript:history.back()" class="text-dark">
        <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a>
@endsection

@section('title')
    Data arsip
@endsection


@section('content')
    <div class="row mt-5 w-100">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card h-100 w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="col-sm-4">
                                                <img src="{{ asset('assets/image/Logo_UnivLampung.png') }}" class="w-100">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-3">
                                            <div class="col-sm-12 text-center">
                                                <a href="{{ route('arsip.download', $arsip->id) }}"
                                                    class="btn btn-primary mt-2 mb-2">Download Pdf</a>
                                                <h5><b>{{ $arsip->judul }}</b></>
                                                </h5>
                                                <span>Oleh: {{ $arsip->user->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Jenis Laporan</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->jenis_laporan }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Ruang Seminar</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->ruang }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Dosen Pembimbing 1</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->dosen_pembimbing_1 }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Dosen Pembimbing 2</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->dosen_pembimbing_2 }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Dosen Pembahas</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->dosen_penguji }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Tanggal Seminar</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                {{ $arsip->tgl_seminar }}
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="d-flex justify-content-between">
                                            <div class="col-sm-3">
                                                <strong>Berita Acara</strong>
                                            </div>
                                            <div class="col-sm-9">
                                                @if ($arsip->berita_acara)
                                                    Ada
                                                @else
                                                    Tidak Ada
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
