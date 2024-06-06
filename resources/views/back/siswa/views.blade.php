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
                            @foreach ($users as $item)
                            <h4 class="header-title">Table Data Siswa | {{ $item->kelas->tingkatan->tingkatan ?? '' }} - {{ $item->kelas->kelas }}</h4>
                            @endforeach
                            <form method="GET" action="{{ route('Data-siswa.view', ['kode_kelas' => $item->kelas->kode_kelas ?? '']) }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="kelas_kode" class="form-control">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($kelas as $kls)
                                                <option value="{{ $kls->kode_kelas }}">{{ $kls->tingkatan->tingkatan ?? '' }} - {{ $kls->kelas }} - {{ $kls->ajaran->tahun_ajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p></p>
                                    <div class="col-md-4 mt-4 mb-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('Users.invoice') }}" class="btn btn-primary">Invoice</a>
                                    </div>
                                </div>
                            </form>
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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    @if($item->kelas)
                                        {{ $item->kelas->tingkatan->tingkatan ?? '' }} - {{ $item->kelas->kelas }}
                                    @else
                                        Tidak Punya Kelas
                                    @endif
                                </td>
                                <td>
                                    @if($item->kelas && $item->kelas->ajaran)
                                        {{ $item->kelas->ajaran->tahun_ajaran }}
                                    @else
                                        Tidak Ada Ajaran
                                    @endif
                                </td>
                                <td>{{ $item->status }}</td>
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