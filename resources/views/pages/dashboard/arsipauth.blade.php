@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table id="myTable" class="table table-stripped w-100">
                                <thead class="justify-content-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Ruang</th>
                                        <th>Pemilik</th>
                                        <th>Berita Acara</th>
                                        <th>Tanggal Seminar</th>
                                        <th class="text-center">Tampilkan di Halaman Arsip ?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; ?>
                                    @foreach ($data as $arsip)
                                        <tr>
                                            <td>{{ $i++ }}</td>

                                            <td style="max-width: 450px"><a href="{{ route('arsip.show', $arsip->id) }}"
                                                    class="text-dark text-bold">{{ $arsip->judul }}</a>
                                            </td>
                                            <td>{{ $arsip->ruang }}</td>
                                            <td>{{ $arsip->user->name }}</td>
                                            <td>
                                                @if ($arsip->berita_acara)
                                                    Ada
                                                @else
                                                    Tidak Ada
                                                @endif
                                            </td>
                                            <td>{{ $arsip->tgl_seminar }}</td>
                                            <td class="text-center">
                                                <div class="col-sm-6 col-md-12 col-lg-12">
                                                    @if ($arsip->status_arsip == 0)
                                                        <form action="{{ route('dashboard.update', $arsip->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-success"
                                                                type="submit">Tampilkan</button>
                                                        </form>
                                                    @else
                                                        <span
                                                            class="bg-danger text-white font-weight-bold py-1 px-2 rounded">Telah
                                                            di tampilkan</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000,
            });
        @endif
    </script>
@endpush
