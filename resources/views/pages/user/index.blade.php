@extends('layouts.app')

@section('title')
    Data Users
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 mt-4">
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('user.create') }}" class="btn btn-success mb-3 p-2"> <i
                                            class="fa fa-user m-2"></i>
                                        <span>Tambah
                                            Data</span></a>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <label for="formFile" class="form-label">Tambahkan data dalam ekstensi .xlsx atau
                                        .xls</label>
                                    <form action="{{ route('template.user') }}" method="post" class="">
                                        @csrf
                                        {{-- <button type="submit">contoh template</button> --}}
                                        <a href="javascript:void(0);" onclick="submitForm()" class="submit-button">download
                                            contoh
                                            template .xlsx</a>
                                    </form>
                                    <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex form-group">
                                            <input class="form-control" type="file" id="formFile" name="fileExcel"
                                                required>
                                            <button class="btn btn-success d-block ml-2" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-stripped w-100">
                                <thead class="justify-content-center">
                                    <tr>
                                        <th style="max-width: 50px">No</th>
                                        <th>Name</th>
                                        <th style="max-width: 150px">Npm</th>
                                        <th style="max-width: 150px">Angkatan</th>
                                        <th style="max-width: 150px">Role</th>
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
                ajax: "{{ route('user.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'npm',
                        name: 'npm'
                    },
                    {
                        data: 'angkatan',
                        name: 'angkatan',
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
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
    <script>
        function submitForm() {
            document.querySelector('form').submit();
        }
    </script>
@endpush
