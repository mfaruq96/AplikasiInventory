{{-- main layout --}}
@extends('layouts.main')

{{-- title --}}
@section('title', 'Stok Produk')

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
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/produk') }}">
            <i class="fas fa-book-open"></i>
            <span>Produk</span></a>
    </li>
@endsection
@section('sidebar-stok')
    <!-- Nav Item - Stok -->
    <li class="nav-item active">
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
            <button type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#modalStok">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Stock Product</a>
            </button>
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

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Barang</th>
                                        <th>Tanggal Register</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_produk as $all)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $all->nama_kategori }}
                                            </td>
                                            <td>
                                                {{ $all->kode_produk }}
                                            </td>
                                            <td>
                                                {{ $all->nama_produk }}
                                            </td>
                                            <td>
                                                {{ $all->jumlah_barang }}
                                            </td>
                                            <td>
                                                {{ date('d F Y', strtotime($all->tgl_register)) }}
                                            </td>
                                            <td>
                                                <form action="{{ url('/stok') }}/{{ $all->id_stok }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="badge badge-danger border-0">
                                                        <i class="fas fa-trash"></i>
                                                        delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalStok" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="modalStokLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalStokLabel">Tambah Stok Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="/stok">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id_produk">Produk</label>
                                        <select class="form-control" id="id_produk" name="id_produk">
                                            @foreach ($tbl_produk as $produk)
                                                <option value="{{ $produk->id_produk }}">
                                                    {{ $produk->nama_produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_barang">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_register">Tanggal Register</label>
                                        <input type="date" class="form-control" id="tgl_register" name="tgl_register">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
