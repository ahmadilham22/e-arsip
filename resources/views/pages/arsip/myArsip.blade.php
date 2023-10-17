@extends('layouts.app')

@section('title')
    Arsipku
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center text-muted">Arsip Terbaru</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($arsips as $a => $value)
                                <div class="d-flex justify-content-between">
                                    <div class="col-sm-7 card-title mb-4">
                                        <strong><a href="{{ route('arsip.edit', $value->id) }}"
                                                class="text-dark">{{ $value->judul }}</a></strong>
                                    </div>
                                    <div class="col-sm-2">
                                        <span>Oleh:</span>
                                        <span class="text-center">
                                            {{ ucwords(strtolower($value->user->name)) }}
                                        </span>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@push('addon-script')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Selamat Datang',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000,
            });
        @endif
    </script>
@endpush
