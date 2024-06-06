@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Data Harga Spp')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body>
    <div class="layout-wrapper">
        @include('back.layout.sidebar')
        @include('back.layout.navbar')
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Table Data Harga</h4>
                            <a href="{{ route('Harga.tambah') }}" class="btn btn-primary mb-4 mt-2">Tambah Data</a>
                            <a href="{{ route('Harga.invoice') }}" class="btn btn-primary mb-4 mt-2">Invoice</a>
                            <p></p>
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nominal</th>
                                        {{-- <th>Tahun Ajaran</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($harga_spp as $item)
                                        <tr>
                                            <th>{{ $item->nominal }}</th>
                                            {{-- <th>{{ $item->ajaran ? $item->ajaran->tahun_ajaran : 'Tidak Punya Ajaran' }}</th> --}}
                                            <td>
                                                <a href="{{ route('Harga.edit', $item->id_spp) }}" class="btn btn-primary shadow btn-xs sharp me-1 mb-1">Edit</a>
                                                <br>
                                                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->id_spp }}" class="btn btn-danger shadow btn-xs sharp me-1">Hapus</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $item->id_spp }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $item->id_spp }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel{{ $item->id_spp }}">Konfirmasi Delete data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Ingin Menghapus Data <b style="color: rgb(0, 17, 255);">{{ $item->nominal }}</b> ?</p>
                                                </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('Harga.delete', $item->id_spp) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
            @include('back.layout.footer')
        </div>
    </div>
</body>
</html>
@endsection
