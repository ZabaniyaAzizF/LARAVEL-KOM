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
                            <h4 class="header-title mb-5">Table Data Pembayaran SPP</h4>

                            <div>
                                <a href="{{ route('Pembayaran.invoice') }}" class="btn btn-primary mb-4 mt-2" >Invoice</a>
                            </div>

                            <h4>Filter Data Pembayaran Siswa</h4>
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('Pembayaran') }}" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" placeholder="Filter by User Name" value="{{ request('name') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Spp Bulan</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Kelas</th>
                                        <th>Nominal</th>
                                        <th>Metode Bayar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->nis }}</td>
                                        <td>{{ $item->spp_bulan }}</td>
                                        <td>{{ $item->ajaran ? $item->ajaran->tahun_ajaran : 'Tidak Ada Ajaran' }}</td>
                                        <td>{{ $item->kelas ? $item->kelas->kelas : 'Tidak Punya Kelas' }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>
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
                                        <td>
                                            <!-- Hide the button when status is "lunas" -->
                                            @if($item->status != 'lunas')
                                                <a href="{{ route('Pembayaran.edit', $item->id_pembayaran) }}" class="btn btn-success">Bayar</a>
                                            @endif
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
