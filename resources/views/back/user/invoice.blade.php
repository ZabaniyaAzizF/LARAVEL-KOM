@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Data Users Invoice')
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
                                                <h5 class="mb-2">Hello, Stanley Jones</h5>
                                                <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                                    promises to provide high quality products for you as well as outstanding
                                                    customer service for every transaction. </p>
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
                                                                <th>Name</th>
                                                                <th>NIS</th>
                                                                <th>Email</th>
                                                                <th>Telepon</th>
                                                                <th>Alamat</th>
                                                                <th>Kelas</th>
                                                                <th>Tahun Ajaran</th>
                                                                <th>Role</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $item)
                                                            <tr>
                                                                <th>{{ $item->name }}</th>
                                                                <th>{{ $item->nis }}</th>
                                                                <td>{{ $item->email }}</td>
                                                                <td>{{ $item->telepon }}</td>
                                                                <td>{{ $item->alamat }}</td>
                                                                <td>{{ $item->kelas ? $item->kelas->kelas : 'Tidak Punya Kelas' }}</td>
                                                                <td>{{ $item->ajaran ? $item->ajaran->tahun_ajaran : 'Tidak Ada Ajaran' }}</td>
                                                                <td>
                                                                    <div class="col-md-10">
                                                                        @php
                                                                        $roleColor = 'secondary'; // Default color
                                                                        
                                                                        // Set color based on user's role
                                                                        if ($item->hasRole('admin')) {
                                                                            $roleColor = 'success';
                                                                        } elseif ($item->hasRole('petugas')) {
                                                                            $roleColor = 'primary';
                                                                        } elseif ($item->hasRole('siswa')) {
                                                                            $roleColor = 'warning';
                                                                        }
                                                                        @endphp
                                                                        
                                                                        <span class="badge badge-outline rounded-pill bg-{{ $roleColor }}">
                                                                            {{ $item->getRoleNames()->isNotEmpty() ? $item->getRoleNames()->first() : 'Undefined Role' }}
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