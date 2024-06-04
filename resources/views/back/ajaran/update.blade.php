@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Dashboard')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

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
                        <h4 class="page-title mb-0">Edit Data Ajaran</h4>
                    </div>
                    <div class="col-lg-6">
                       <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ajaran</a></li>
                            <li class="breadcrumb-item active">Datatables</li>
                            <li class="breadcrumb-item active">Edit Data Ajaran</li>
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
                            <h4 class="header-title">Form Edit Data</h4>

                            <p></p>

                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <form class="form-horizontal" action="{{ route('Ajaran.update', $data->kode_ajaran) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="simpleinput">Kode Ajaran</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="kode_ajaran" value="{{ $data->kode_ajaran }}" readonly>
                                                    @error('kode_ajaran')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="example-email">Tahun Ajaran</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="tahun_ajaran" class="form-control" value="{{ $data->tahun_ajaran }}" placeholder="Isi Tahun Ajaran">
                                                    @error('tahun_ajaran')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="status">Status</label>
                                                <div class="col-md-10">
                                                    <select name="status" class="form-control">
                                                        <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                        <option value="tidak aktif" {{ $data->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                    </select>
                                                    @error('status')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>                                   
                                            <div>
                                                <button class="btn btn-primary" type="submit"> Edit </button>
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

</html>
@endsection
