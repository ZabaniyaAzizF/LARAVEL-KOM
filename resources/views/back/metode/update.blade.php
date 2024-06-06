@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Edit Data Metode')
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
                                    <h4 class="page-title mb-0">Edit Data Metode</h4>
                                </div>
                                <div class="col-lg-6">
                                   <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Metode</a></li>
                                        <li class="breadcrumb-item active">Datatables</li>
                                        <li class="breadcrumb-item active">Edit Data Metode</li>
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
                                        <h4 class="header-title">Form Tambah Data</h4>
    
                                        <p></p>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" action="{{route('Metode.update', $data->kode_metode) }}" method="post" >
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="simpleinput">Kode Metode</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="kode_metode" readonly id="kode_metode" type="text" value="{{ $data->kode_metode }}">
                                                                @error('kode_metode')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-email">Metode Pembayaran</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="metode_pembayaran" class="form-control" placeholder="Isi Metode Pembayaran" value="{{ $data->metode_pembayaran }}">
                                                                @error('metode_pembayaran')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label">Tipe Pembayaran</label>
                                                            <div class="col-md-10">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="tipe_pembayaran" id="bulanan" value="Bulanan" {{ $data->jenis == 'Bulanan' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="bulanan">
                                                                        Bulanan
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="tipe_pembayaran" id="non_bulanan" value="Non Bulanan" {{ $data->jenis == 'Non Bulanan' ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="non_bulanan">
                                                                        Non Bulanan
                                                                    </label>
                                                                </div>
                                                                @error('tipe_pembayaran')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        <div>
                                                            <button class="btn btn-primary" type="submit"> Update </button>
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