{{-- main layout --}}
@extends('layouts.main')

{{-- title --}}
@section('title', 'Kategori')

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
    <li class="nav-item active">
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
            <button type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#modalKategori">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tbl_kategori as $kategori)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $kategori->nama_kategori }}
                                            </td>
                                            <td>
                                                <button type="submit" class="badge badge-success border-0"
                                                    data-toggle="modal"
                                                    data-target="#modalEditKategori{{ $kategori->id_kategori }}">
                                                    <i class="fas fa-edit"></i>
                                                    edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEditKategori{{ $kategori->id_kategori }}"
                                                    data-backdrop="static" data-keyboard="false" tabindex="-1"
                                                    aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalEditKategoriLabel">Edit
                                                                    Nama Kategori</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">

                                                                <form action="/kategori/{{ $kategori->id_kategori }}">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label for="nama_kategori">Nama
                                                                            Kategori</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_kategori" name="nama_kategori"
                                                                            value="{{ $kategori->nama_kategori }}">
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="{{ url('/kategori') }}/{{ $kategori->id_kategori }}"
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
                <div class="modal fade" id="modalKategori" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="modalKategoriLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="/kategori">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_kategori">Nama Kategori</label>
                                        <input type="text" class="form-control" id="nama_kategori"
                                            name="nama_kategori">
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
