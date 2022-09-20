{{-- main layout --}}
@extends('layouts.main')

{{-- title --}}
@section('title', 'Produk Detail')

{{-- sidebar --}}
@section('sidebar-dashboard')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
@endsection
@section('sidebar-kategori')
    <!-- Nav Item - Kategori -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/kategori') }}">
            <i class="fas fa-book"></i>
            <span>Kategori</span></a>
    </li>
@endsection
@section('sidebar-produk')
    <!-- Nav Item - Produk -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/produk') }}">
            <i class="fas fa-book-open"></i>
            <span>Produk</span></a>
    </li>
@endsection
@section('sidebar-stok')
    <!-- Nav Item - Stok -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/stok') }}">
            <i class="fas fa-book-open"></i>
            <span>Stok Produk</span></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
        </div>

        {{-- alert status 1 --}}
        <div class="row">
            <div class="col-lg-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        {{-- alert status 2 --}}
        <div class="row">
            <div class="col-lg-12">
                @if (session('status2'))
                    <div class="alert alert-danger">
                        {{ session('status2') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ url('images') }}/{{ $tbl_produk->foto_produk_satu }}" class="rounded img-thumbnail"
                                alt="...">
                            <img src="{{ url('images') }}/{{ $tbl_produk->foto_produk_dua }}" class="rounded img-thumbnail"
                                alt="...">
                            <img src="{{ url('images') }}/{{ $tbl_produk->foto_produk_tiga }}"
                                class="rounded img-thumbnail" alt="...">
                        </div>
                        <table class="table mt-4" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>Kode Produk</td>
                                    <td>{{ $tbl_produk->kode_produk }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>{{ $tbl_produk->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td>{{ $tbl_produk->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Register</td>
                                    <td>{{ $tbl_produk->tgl_register }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
