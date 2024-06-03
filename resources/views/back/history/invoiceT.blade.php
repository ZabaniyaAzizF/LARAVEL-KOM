@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Tunggakan Pembayaran Spp Invoice')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="layout-wrapper">
            @include('back.layout.sidebar')

            @include('back.layout.navbar')

                <div class="container-fluid">
                            <!-- start page title -->
                            <div class="py-3 py-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="page-title mb-3">Laporan Data Users</h4>
                                        <?php  $setting = App\Models\Setting::get()->first() ?>
                                        <h1>{{ $setting->nama }}</h1>

                                        <!-- Brand Logo Light -->
                                        <a class='logo-light' href='{{ route('dashboard')}}'>
                                            <img src="{{ asset('storage/setting/'.$setting->path_logo)}}" class="mb-3" style="" width="200px" alt="">
                                        </a><br>

                                    </div>
                                    <div class="col-lg-6">
                                       <div class="d-none d-lg-block">
                                        <ol class="breadcrumb m-0 float-end">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Extra Pages</a></li>
                                            <li class="breadcrumb-item active">Invoice</li>
                                        </ol>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title -->
    
                            <div class="row my-3">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <label > Alamat </label>
                                                <h5 class="mb-2">{{ $setting->alamat }}</h5>
                                                <label > NO Telepon </label>
                                                <h5 class="mb-5">{{ $setting->telepon }}</h5>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->
                        
                                    <div class="row">
                                        <div class="col-12">
                                                    <h4 class="header-title">Table Data Users</h4>
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
                                                                <td>{{ $item->ajaran ? $item->ajaran->tahun_ajaran : 'Tidak Ada Ajaran' }}</td>
                                                                <td>{{ $item->kelas ? $item->kelas->kelas : 'Tidak Punya Kelas' }}</td>
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
                                        </div><!-- end col-->
                                    </div>
        
                                    <div class="mt-4 mb-1">
                                        <div class="text-end d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row --> 
</body>
</html>
@endsection