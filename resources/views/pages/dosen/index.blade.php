@extends('layouts.app')

@section('title')
    Data Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-primary text-center" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> --}}
                {{ session('success') }}
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger text-center" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button> --}}
                {{ session('delete') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('dosen.create') }}" class="btn btn-success mb-3 p-2"> <i
                                class="fa fa-user m-2"></i>
                            <span>Tambah
                                Data</span></a>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-stripped w-100">
                                <thead class="justify-content-center">
                                    <tr>
                                        <th style="max-width: 50px">No</th>
                                        <th>Name</th>
                                        <th style="max-width: 200px">Nip</th>
                                        <th class="text-center" style="max-width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                ajax: "{{ route('dosen.list') }}",
                columns: [{
                        data: null,
                        render: function(data, type, row) {
                            return i++;
                        },
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nip',
                        name: 'nip'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
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
