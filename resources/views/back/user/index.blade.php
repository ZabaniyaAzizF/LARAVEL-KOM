@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Data Users')
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
                            <h4 class="header-title">Table Data Users</h4>
                            <div>
                                <a href="{{ route('Users.tambah') }}" class="btn btn-primary mb-4 mt-2">Tambah Data</a>
                            </div>
                            <form method="GET" action="{{ route('Users') }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="name" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="col-md-4">
                                        <select name="kelas_kode" class="form-control">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($kelas as $kelas)
                                                <option value="{{ $kelas->kode_kelas }}">{{ $kelas->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="ajaran_kode" class="form-control">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            @foreach($ajaran as $ajaran)
                                                <option value="{{ $ajaran->kode_ajaran }}">{{ $ajaran->tahun_ajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-4 mb-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>foto_profile</th>
                                        <th>NIS</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <th>{{ $item->name }}</th>
                                        <th><img src="{{ asset('storage/foto_profile/'.$item->foto_profile) }}" width="50px" alt=""></th>
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
                                        <td>
                                            <a href="{{ route('Users.edit', $item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1 mb-1">Edit</a>
                                            <br>
                                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id }}" class="btn btn-danger shadow btn-xs sharp me-1">Hapus</a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Ingin Menghapus Data Akun Ini Atas Nama <b style="color: rgb(0, 17, 255);">{{ $item->name }}</b> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('Users.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
