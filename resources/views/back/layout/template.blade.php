<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 02:04:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">

    <link href="{{ asset('admin/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('admin/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin/js/config.js') }}"></script>
</head>

<body>

    <!-- Begin page -->
    <div>
        <!-- ========== Left Sidebar ========== -->
        

        

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

                <!-- Start Content-->
                <div >
                    @yield('content')
                </div>


        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{ asset('admin/js/vendor.min.js') }}"></script>
    <script src="{{ asset('admin/js/app.js') }}"></script>

    <!-- Knob charts js -->
    <script src="{{ asset('admin/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- Sparkline Js-->
    <script src="{{ asset('admin/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('admin/libs/morris.js/morris.min.js') }}"></script>

    <script src="{{ asset('admin/libs/raphael/raphael.min.js') }}"></script>

    <!-- Dashboard init-->
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>

    <!-- custom dmeo js-->
    <script src="{{asset('admin/js/pages/materialdesign.js')}}  "></script>
</body>


<!-- Mirrored from myrathemes.com/dashtrap/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 May 2024 02:04:30 GMT -->
</html>