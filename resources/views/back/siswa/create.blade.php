@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Data Siswa Tambah')
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
                        <h4 class="page-title mb-0">Tambah Data Siswa</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Siswa</a></li>
                                <li class="breadcrumb-item active">Tambah Data Siswa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Form Tambah Data Siswa</h4>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{ route('Data-siswa.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="simpleinput">Nama</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nama" placeholder="Isi Nama Anda">
                                            @error('nama')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="simpleinput">NIS</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="nis" placeholder="Isi NIS Anda">
                                            @error('nis')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="example-email">Telepon</label>
                                        <div class="col-md-10">
                                            <input type="number" name="telepon" class="form-control" placeholder="Isi No Telepon Anda">
                                            @error('telepon')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="example-email">Alamat</label>
                                        <div class="col-md-10">
                                            <input type="text" name="alamat" class="form-control" placeholder="Isi Alamat Rumah Anda">
                                            @error('alamat')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label class="col-md-2 col-form-label" for="kelas">Kelas</label>
                                        <div class="col-md-10">
                                            <select class="form-control br-style" id="kelas" name="kelas_kode">
                                                <option value="">Pilih Kelas</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->kode_kelas }}">{{ $class->tingkatan->tingkatan ?? '' }} - {{ $class->kelas }} - {{ $class->ajaran->tahun_ajaran }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas_kode')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" type="submit"> Tambah </button>
                                    </div>
                                </form>
                            </div>
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
