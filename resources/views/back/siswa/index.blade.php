@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Data Siswa')
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
                            <div class="col-md-4 mt-4 mb-3">
                                <a href="{{ route('Data-siswa.create') }}" class="btn btn-primary" >Tambah</a>
                            </div>
                            {{-- <form method="GET" action="{{ route('Data-siswa') }}">
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
                                        <a href="{{ route('Data-siswa.invoice') }}" class="btn btn-primary" >Invoice</a>
                                    </div>
                                </div>
                            </form> --}}
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>NIS</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_siswa as $item)
                                        <tr>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->nis }}</td>
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
                                            <td>
                                                <a href="{{ route('Data-siswa.edit', $item->id_siswa) }}" class="btn btn-primary shadow btn-xs sharp me-1 mb-1">Edit</a>
                                                <br>
                                                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id_siswa }}" class="btn btn-danger shadow btn-xs sharp me-1">Hapus</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $item->id_siswa }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda Yakin Ingin Menghapus Data <b style="color: rgb(0, 17, 255);">{{ $item->nama_siswa }}</b>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('Data-siswa.delete', $item->id_siswa) }}" method="POST">
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
