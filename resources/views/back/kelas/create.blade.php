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
                                                    <form class="form-horizontal" action="{{route('Data-kelas.store') }}" method="post" enctype="multipart/form-data" >
                                                        @csrf
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="simpleinput">Kode Kelas</label>
                                                            <div class="col-md-10">
                                                            <?php
                                                                $kodekelas = autonumber('kelas', 'kode_kelas', 3, 'KLS');
                                                            ?>
                                                                <input class="form-control" name="kode_kelas" readonly id="kode_kelas" type="text" value="<?= $kodekelas ?>">
                                                                @error('kode_kelas')
                                                                    <small>{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="example-email">Nama Kelas</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="kelas" class="form-control"  placeholder="Isi Nama Kelas">
                                                                @error('kelas')
                                                                <small>{{ $message }}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row"> 
                                                            <label class="col-md-2 col-form-label" for="ajaran">Tingkatan</label>
                                                            <div class="col-md-10">
                                                                <select class="form-control br-style" id="tingkat_kode" name="tingkat_kode">
                                                                    <option value="">Pilih Tingkatan</option>
                                                                    @foreach($tingkat as $year)
                                                                        <option value="{{ $year->kode_tingkat }}">{{ $year->tingkatan }}</option>
                                                                    @endforeach
                                                                </select>                                                                
                                                            </div>
                                                        </div>

                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="ajaran">Tahun Ajaran</label>
                                                            <div class="col-md-10">
                                                                <select class="form-control br-style" id="ajaran" name="ajaran_kode">
                                                                    @foreach($ajaran as $year)
                                                                        <option value="{{ $year->kode_ajaran }}" {{ $loop->first ? 'selected' : '' }}>{{ $year->tahun_ajaran }}</option>
                                                                    @endforeach
                                                                </select>
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