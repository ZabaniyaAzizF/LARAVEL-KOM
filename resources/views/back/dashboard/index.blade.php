@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Dashboard')
@section('content')

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 02:04:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
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
                        <h4 class="page-title mb-0">Dashboard</h4>
                    </div>
                    <div class="col-lg-6">
                       <div class="d-none d-lg-block">
                        <ol class="breadcrumb m-0 float-end">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashtrap</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                       </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-end">Daily</span>
                                <h5 class="card-title mb-0">Cost per Unit</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        $17.21
                                    </h2>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="text-muted">12.5% <i
                                            class="mdi mdi-arrow-up text-success"></i></span>
                                </div>
                            </div>
            
                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->
            
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-end">Per Week</span>
                                <h5 class="card-title mb-0">Market Revenue</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        $1875.54
                                    </h2>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="text-muted">18.71% <i
                                            class="mdi mdi-arrow-down text-danger"></i></span>
                                </div>
                            </div>
            
                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->
            
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-end">Per Month</span>
                                <h5 class="card-title mb-0">Expenses</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        $784.62
                                    </h2>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="text-muted">57.86% <i
                                            class="mdi mdi-arrow-up text-success"></i></span>
                                </div>
                            </div>
            
                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div>
                    <!--end card-->
                </div> <!-- end col-->
            
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-end">All Time</span>
                                <h5 class="card-title mb-0">Daily Visits</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        1,15,187
                                    </h2>
                                </div>
                                <div class="col-4 text-end">
                                    <span class="text-muted">17.8% <i
                                            class="mdi mdi-arrow-down text-danger"></i></span>
                                </div>
                            </div>
            
                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            
            </div> <!-- container -->
    </div>
    <!-- END wrapper -->
</body>


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 02:04:30 GMT -->
</html>
@endsection