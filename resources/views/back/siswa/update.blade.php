@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

    
<!-- Mirrored from myrathemes.com/dashtrap/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 May 2024 04:07:18 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Myra Studio" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

    </head>

    <body>

        <!-- Begin page -->
        <div class="layout-wrapper">
            @include('back.layout.sidebar')

            @include('back.layout.navbar')

                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="py-3 py-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title mb-0">Tambah Data Siswa</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Siswa</a></li>
                                        <li class="breadcrumb-item active">Datatables</li>
                                        <li class="breadcrumb-item active">Tambah Data Siswa</li>
                                    </ol>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Form Tambah Data </h4>
    
                                        <p></p>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" action="{{route('Data-siswa.update', $data->id_siswa)}}" method="post" >
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="simpleinput">NIS</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="nis" value="{{ $data->nis}}" readonly>
                                                                @error('nama')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="simpleinput">Nama Siswa</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="nama" value="{{ $data->nama_siswa}}">
                                                                @error('nama')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-email">Kelas</label>
                                                            <div class="col-md-10">
                                                                <select class="form-control br-style" id="kelas_kode" name="kelas_kode">
                                                                    <option value="">Pilih Kelas</option>
                                                                    @foreach ($kelas as $item)
                                                                        <option value="{{ $item->kode_kelas }}">{{ $item->kelas }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-email">Telepon</label>
                                                            <div class="col-md-10">
                                                                <input type="number" name="telepon" class="form-control" value="{{ $data->telepon}}">
                                                                @error('telepon')
                                                                <small>{{ $message }}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-email">Alamat</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="alamat" class="form-control" value="{{ $data->alamat}}">
                                                                @error('alamat')
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
    
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                <!-- Footer Start -->
                @include('back.layout.footer')
                <!-- end Footer -->
        </div>
        <!-- END wrapper -->        
    </body>

<!-- Mirrored from myrathemes.com/dashtrap/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 May 2024 04:07:26 GMT -->
</html>
@endsection