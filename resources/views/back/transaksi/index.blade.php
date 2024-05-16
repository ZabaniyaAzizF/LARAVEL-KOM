@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Pembayaran SPP')
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
                                    <h4 class="page-title mb-0">Forms Pembayaran SPP</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
                                        <li class="breadcrumb-item active">Forms</li>
                                        <li class="breadcrumb-item active">Pembayaran SPP</li>
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
                                        <h4 class="header-title">Form Pembayaran SPP</h4>
    
                                        <p></p>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" action="{{ route('Transaksi.store') }}" method="POST" enctype="multipart/form-data" >
                                                        @csrf
                                                        <div class="mb-2 row">
                                                            <div class="col-md-6">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">Nama Siswa</label>
                                                                <select class="form-control br-style" id="role" name="role">
                                                                    <option value="">Pilih Metode Pembayaran</option>
                                                                    <option value="">Transfer</option>
                                                                    <option value="">Cash</option>
                                                                </select>
                                                                @error('nama')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">NIS</label>
                                                                <input type="text" class="form-control" name="nama" value="" readonly placeholder="Isi Nama Anda">
                                                            </div>
                                                        </div>

                                                        <div class="mb-2 row">
                                                            <div class="col-md-6 mt-1">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">Metode Pembayaran</label>
                                                                <select class="form-control br-style" id="role" name="role">
                                                                    <option value="">Pilih Metode Pembayaran</option>
                                                                    <option value="">Transfer</option>
                                                                    <option value="">Cash</option>
                                                                </select>
                                                                @error('nama')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mt-4">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">Petugas</label>
                                                                <input type="text" class="form-control" name="nama" value="" placeholder="Isi Nama Anda">
                                                            </div>
                                                        </div>

                                                        <div class="mb-2 row">
                                                            <div class="col-md-6 mt-4">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">Kelas</label>
                                                                <select class="form-control br-style" id="role" name="role">
                                                                    <option value="">Pilih Metode Pembayaran</option>
                                                                    <option value="">Transfer</option>
                                                                    <option value="">Cash</option>
                                                                </select>
                                                                @error('nama')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mt-4">
                                                                <label class="col-md-2 col-form-label" for="simpleinput">Nominal</label>
                                                                <input type="text" class="form-control" name="nama" value="" placeholder="Isi Nama Anda">
                                                            </div>
                                                        </div>

                                                        <div class="mt-5">
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