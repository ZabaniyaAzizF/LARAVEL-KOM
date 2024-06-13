@extends('back.layout.template')
@section('title', 'Edit Pembayaran - ' . $pembayaran->nama_siswa)
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
                        <h4 class="page-title mb-0">Edit Pembayaran</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Edit</li>
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
                            <h4 class="header-title">Edit Data Pembayaran</h4>

                            <form method="POST" action="{{ route('Pembayaran.update', $pembayaran->kode_pembayaran) }}">
                                @csrf
                                @method('PUT') <!-- Ensure the form uses POST method -->
                                <input type="hidden" name="_method" value="PUT"> <!-- Spoof the PUT method -->

                                <div class="mb-3">
                                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" value="{{ $pembayaran->nama_siswa }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" value="{{ $pembayaran->nis }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" value="{{ $pembayaran->kelas }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="spp_bulan" class="form-label">Spp Bulan</label>
                                    <input type="text" class="form-control" name="spp_bulan" id="spp_bulan" value="{{ old('spp_bulan', $pembayaran->bulan) }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="nominal" class="form-label">Nominal</label>
                                    <input type="text" class="form-control" name="nominal" id="nominal" value="{{ old('nominal', $pembayaran->nominal) }}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Metode Pembayaran</label>
                                    <select class="form-control" id="jenis" name="jenis">
                                        <option value="Cash" {{ old('jenis', $pembayaran->jenis) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Transfer" {{ old('jenis', $pembayaran->jenis) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="lunas" {{ old('status', $pembayaran->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        <option value="belum lunas" {{ old('status', $pembayaran->status) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="petugas" class="form-label">Nama Petugas</label>
                                    <input type="text" class="form-control" name="petugas" id="petugas" value="{{ old('petugas', $loggedInUser->name) }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('Pembayaran') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
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
