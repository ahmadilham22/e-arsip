@extends('layouts.app')

@section('arrow')
    <a href="javascript:history.back()" class="text-dark">
        <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a>
@endsection

@section('title')
    Arsip
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="angkatanFilter">Angkatan:</label>
                                        <select class="form-control" id="angkatanFilter">
                                            <option value="">Tampilkan Semua</option>
                                            @foreach ($generations as $generation)
                                                <option value="{{ $generation }}">{{ $generation }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="myTable" class="table table-stripped w-100">
                                <thead class="justify-content-center">
                                    <tr>
                                        <th>No</th>
                                        <th style="max-width: 450px">Judul</th>
                                        <th>Ruang</th>
                                        <th>Jenis Laporan</th>
                                        <th>Pemilik</th>
                                        <th>Angkatan</th>
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
        $('#angkatanFilter').on('change', function() {
            // var angkatan = $(this).val();

            // $('#myTable').DataTable().ajax.url('{{ route('arsip.list') }}?angkatan=' + angkatan).load();
            var angkatan = $(this).val();
            var tahun = {!! json_encode($year) !!}; // Mengambil tahun dari data yang tersedia di Blade

            // Perbarui URL Ajax dengan tahun dan angkatan
            var url = '{{ route('arsip.list') }}?tahun=' + tahun;
            if (angkatan) {
                url += '&angkatan=' + angkatan;
            }

            $('#myTable').DataTable().ajax.url(url).load();
        });
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                processing: true,
                autoWidth: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('arsip.tahun.detail', ['year' => $year]) }}',
                    data: function(d) {
                        d.tahun = $('#tahunFilter').val();
                        d.angkatan = $('#angkatanFilter').val();
                    }
                },
                columns: [{
                        data: 'index',
                        name: 'index',
                        orderable: false,
                        searchable: false,
                    }, {
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
                        data: 'user.angkatan',
                        data: 'user.angkatan',
                    },
                    {
                        data: 'tgl_seminar',
                        name: 'tanggal seminar',
                        render: function(data) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('#angkatanFilter').on('change', function() {
                table.draw(); // Memanggil metode draw untuk memperbarui tabel saat filter angkatan berubah
            });
        });
    </script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        @if (session('delete'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('delete') }}',
                showConfirmButton: true,
                timer: 3000,
            });
        @elseif (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000,
            });
        @endif
    </script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    {{-- <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000,
            });
        @endif
    </script> --}}
@endpush
