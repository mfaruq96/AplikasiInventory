{{-- main layout --}}
@extends('layouts.main')

{{-- title --}}
@section('title', 'Dashboard')

{{-- sidebar --}}
@section('sidebar-dashboard')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
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
    <li class="nav-item">
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

                        <div class="row">
                            <!-- Kategori -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Kategori</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tbl_kategori }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-book fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Produk</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tbl_produk }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="inventoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Tanggal Register</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_produk as $produk)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $produk->kode_produk }}
                                            </td>
                                            <td>
                                                {{ $produk->nama_produk }}
                                            </td>
                                            <td>
                                                {{ $produk->nama_kategori }}
                                            </td>
                                            <td>
                                                {{ $produk->jumlah_barang }}
                                            </td>
                                            <td>
                                                {{ date('d F Y', strtotime($produk->tgl_register)) }}
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
