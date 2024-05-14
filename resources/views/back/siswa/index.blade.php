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
                            <h4 class="header-title">Table Data Siswa</h4>

                            @if($roles->contains('admin')) <!-- Show button only for admin -->
                                <a href="{{ route('Users.tambah')}}" class="btn btn-primary mb-4 mt-2">Tambah Data</a>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>foto_profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = $users->firstItem() ?>
                                    @foreach ($users as $item)
                                        @if($item->roles->contains('name', 'siswa'))
                                            <tr>
                                                <th>{{ $i }}</th>
                                                <th><img src="{{ asset('storage/foto_profile/'.$item->foto_profile) }}" width="50px" alt=""></th>
                                                <th>{{ $item->name }}</th>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    @foreach($item->roles as $role)
                                                        <span class="badge bg-info">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if($roles->contains('admin') || $roles->contains('editor')) <!-- Allow edit for admin and editor -->
                                                        <a href="{{ route('Users.edit', $item->id) }}" class="btn btn-primary shadow btn-xs sharp me-1 mb-1">Edit</a>
                                                    @endif
                                                    @if($roles->contains('admin')) <!-- Allow delete only for admin -->
                                                        <br>
                                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id }}" class="btn btn-danger shadow btn-xs sharp me-1">Hapus</a>
                                                    @endif
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
                                            <?php ++$i ?>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $users->links() }}
                            </div>
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
