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
                        <h4 class="page-title mb-0">Datatables</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
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
                            <h4 class="header-title mb-5">Table Data Pembayaran SPP Siswa</h4>

                            <h4>Filter Data Pembayaran Siswa</h4>
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('History') }}" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="spp_bulan" class="form-control">
                                            <option value="">Filter berdasarkan Bulan</option>
                                            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                <option value="{{ $bulan }}" {{ request('spp_bulan') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="tahun_ajaran" class="form-control">
                                            <option value="">Filter berdasarkan Tahun Ajaran</option>
                                            @foreach ($academicYears as $year)
                                                <option value="{{ $year }}" {{ request('tahun_ajaran') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <a href="{{ route('Users.invoice') }}" class="btn btn-primary mb-4 mt-2" >Invoice</a>    
                            </div>                                     
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Spp Bulan</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Kelas</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->nis }}</td>
                                        <td>{{ $item->spp_bulan }}</td>
                                        <td>{{ $item->ajaran->tahun_ajaran }}</td>
                                        <td>{{ $item->kelas->kelas }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <<td>
                                            <div class="col-md-10">
                                                @php
                                                $statusColor = 'secondary'; // Default color
                                            
                                                // Set color based on payment status
                                                if ($item->status == 'lunas') {
                                                    $statusColor = 'success';
                                                } elseif ($item->status == 'belum lunas') {
                                                    $statusColor = 'danger';
                                                }
                                                @endphp
                                            
                                                <span class="badge badge-outline rounded-pill bg-{{ $statusColor }}">
                                                    {{ $item->status == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            <!-- Footer Start -->
            @include('back.layout.footer')
            <!-- end Footer -->
        </div>
        <!-- END wrapper -->
</body>

</html>
@endsection
