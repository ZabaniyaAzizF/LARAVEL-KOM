@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Form Tambah Harga Spp')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body>
    <div class="layout-wrapper">
        @include('back.layout.sidebar')
        @include('back.layout.navbar')
        <div class="container-fluid">
            <div class="py-3 py-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-title mb-0">Edit Data Users</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
                                <li class="breadcrumb-item active">Edit Data Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Form Tambah Data</h4>
                            <p></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <form class="form-horizontal" action="{{ route('Harga.update', $harga->id_spp) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="nominal">Nominal</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="nominal" class="form-control" value="{{ $harga->nominal }}" placeholder="Isi Nominal">
                                                    @error('nominal')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="ajaran">Tahun Ajaran</label>
                                                <div class="col-md-10">
                                                    <select class="form-control br-style" id="ajaran" name="ajaran_kode">
                                                        @foreach($ajaran as $year)
                                                            <option value="{{ $year->kode_ajaran }}" {{ $harga->ajaran_kode == $year->kode_ajaran ? 'selected' : '' }}>{{ $year->tahun_ajaran }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="metode_pembayaran">Jenis Pembayaran</label>
                                                <div class="col-md-10">
                                                    <select class="form-control br-style" id="metode_pembayaran" name="metode_pembayaran">
                                                        @foreach($metode as $m)
                                                            <option value="{{ $m->kode_metode }}" {{ $harga->metode_pembayaran == $m->kode_metode ? 'selected' : '' }}>{{ $m->metode_pembayaran }} - {{ $m->jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            @include('back.layout.footer')
        </div>
    </div>
</body>
</html>
@endsection
