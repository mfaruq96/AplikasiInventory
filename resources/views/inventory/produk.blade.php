{{-- main layout --}}
@extends('layouts.main')

{{-- title --}}
@section('title', 'Produk')

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
            <button type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#modalProdukAdd">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Product</a>
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
                                        <th>Tanggal Register</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tbl_produk as $produk)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $produk->nama_kategori }}
                                            </td>
                                            <td>
                                                {{ $produk->kode_produk }}
                                            </td>
                                            <td>
                                                {{ $produk->nama_produk }}
                                            </td>
                                            <td>
                                                {{ date('d F Y', strtotime($produk->tgl_register)) }}
                                            </td>
                                            <td>
                                                <form action="{{ url('/produk/detail') }}/{{ $produk->id_produk }}"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="badge badge-info border-0">
                                                        <i class="fas fa-info"></i>
                                                        detail
                                                    </button>
                                                </form>
                                                <button type="submit" class="badge badge-success border-0"
                                                    data-toggle="modal"
                                                    data-target="#modalEditProduk{{ $produk->id_produk }}">
                                                    <i class="fas fa-edit"></i>
                                                    edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEditProduk{{ $produk->id_produk }}"
                                                    data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                    aria-labelledby="modalEditProdukLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalEditProdukLabel">Edit
                                                                    Produk</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form method="POST"
                                                                    action="/produk/{{ $produk->id_produk }}"
                                                                    class="text-left" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="kategori">Kategori</label>
                                                                        <select class="form-control" id="kategori"
                                                                            name="id_kategori">
                                                                            <option value="{{ $produk->id_kategori }}">
                                                                                {{ $produk->nama_kategori }}</option>
                                                                            @foreach ($tbl_kategori as $kategori)
                                                                                <option
                                                                                    value="{{ $kategori->id_kategori }}">
                                                                                    {{ $kategori->nama_kategori }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kode_produk">Kode Produk</label>
                                                                        <input type="text" class="form-control"
                                                                            id="kode_produk" name="kode_produk"
                                                                            value="{{ $produk->kode_produk }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama_produk">Nama Produk</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_produk" name="nama_produk"
                                                                            value="{{ $produk->nama_produk }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="foto_produk_satu">Foto Produk</label>
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <img class="img-thumbnail"
                                                                                    src="{{ url('images') }}/{{ $produk->foto_produk_satu }}">
                                                                            </div>
                                                                            <div class="col-sm-9">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        id="foto_produk_satu"
                                                                                        name="foto_produk_satu">
                                                                                    <label for="foto_produk_satu"
                                                                                        class="custom-file-label">Choose
                                                                                        file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <img class="img-thumbnail"
                                                                                    src="{{ url('images') }}/{{ $produk->foto_produk_dua }}">
                                                                            </div>
                                                                            <div class="col-sm-9">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        id="foto_produk_dua"
                                                                                        name="foto_produk_dua">
                                                                                    <label for="image_dua"
                                                                                        class="custom-file-label">Choose
                                                                                        file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <img class="img-thumbnail"
                                                                                    src="{{ url('images') }}/{{ $produk->foto_produk_tiga }}">
                                                                            </div>
                                                                            <div class="col-sm-9">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input"
                                                                                        id="foto_produk_tiga"
                                                                                        name="foto_produk_tiga">
                                                                                    <label for="image_tiga"
                                                                                        class="custom-file-label">Choose
                                                                                        file</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_register">Tanggal
                                                                            Register</label>
                                                                        <input type="date" class="form-control"
                                                                            id="tgl_register" name="tgl_register"
                                                                            value="{{ $produk->tgl_register }}">
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ url('/produk') }}/{{ $produk->id_produk }}"
                                                    method="post" class="d-inline">
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
                <div class="modal fade" id="modalProdukAdd" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="modalProdukAddLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalProdukAddLabel">Tambah Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="/produk" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select class="form-control" id="kategori" name="id_kategori">
                                            @foreach ($tbl_kategori as $kategori)
                                                <option value="{{ $kategori->id_kategori }}">
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_produk">Kode Produk</label>
                                        <input type="text" class="form-control" id="kode_produk" name="kode_produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="foto_produk_satu">Foto Produk</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_produk_satu"
                                                name="foto_produk_satu">
                                            <label for="image_satu" class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_produk_dua"
                                                name="foto_produk_dua">
                                            <label for="image_dua" class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_produk_tiga"
                                                name="foto_produk_tiga">
                                            <label for="image_tiga" class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_register">Tanggal Register</label>
                                        <input type="date" class="form-control" id="tgl_register"
                                            name="tgl_register">
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
