@extends('layouts.app')

@section('title')
    Data Arsip
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-primary text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('delete') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('arsip.create') }}" class="btn btn-success mb-3 p-2"> <i
                                class="fa fa-user m-2"></i>
                            <span>Tambah
                                Data</span></a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-stripped w-100">
                                <thead class="justify-content-center">
                                    <tr>
                                        <th>No</th>
                                        <th style="max-width: 450px">Judul</th>
                                        <th>Ruang</th>
                                        <th>Jenis Laporan</th>
                                        {{-- <th>Dosen Pembimbing 1</th>
                                        <th>Dosen Pembimbing 2</th>
                                        <th>Dosen Penguji</th> --}}
                                        <th>Pemilik</th>
                                        <th>Tanggal Seminar</th>
                                        <th class="text-center" style="width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tes">
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
    <script>
        var i = 1;
        $(document).ready(function() {
            $('#myTable').DataTable({
                serverSide: true,
                ajax: "{{ route('arsip.list') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row) {
                            return i++;
                        },
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'ruang',
                        name: 'ruang'
                    },
                    {
                        data: 'jenis_laporan',
                        name: 'jenis laporan'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'tgl_seminar',
                        name: 'tanggal seminar'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                error: function(xhr, error, thrown) {
                    if (xhr.status === 419) {
                        // Lifesession habis, berikan tindakan yang sesuai
                        alert("Sesi Anda telah habis. Silakan login kembali.");
                        // Atau alihkan pengguna ke halaman login, dsb.
                    }
                },
            });
        });
    </script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
@endpush
