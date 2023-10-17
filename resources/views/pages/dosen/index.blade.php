@extends('layouts.app')

@section('title')
    Data Dosen
@endsection

@section('content')
    <div class="container-fluid">
        {{-- @if (session('success'))
            <div class="alert alert-primary text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger text-center" role="alert">
                {{ session('delete') }}
            </div>
        @endif --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('dosen.create') }}" class="btn btn-success mb-3 p-2"> <i class="fa fa-user m-2"></i>
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
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('dosen.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
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
    {{-- <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script> --}}
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
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: '{{ $errors->first() }}',
                showConfirmButton: true,
                timer: 5000,
            });
        @endif
    </script>
@endpush
