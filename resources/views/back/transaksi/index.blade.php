@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Pembayaran SPP')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Include jQuery for simplicity -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="layout-wrapper">
        @include('back.layout.sidebar')
        @include('back.layout.navbar')
        <div class="container-fluid">
            <div class="py-3 py-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-title mb-0">Forms Pembayaran SPP</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Forms</li>
                                <li class="breadcrumb-item active">Pembayaran SPP</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Form Pembayaran SPP</h4>
                            <p></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <form class="form-horizontal" action="{{ route('Transaksi.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-2 row">
                                                <div class="col-md-6">
                                                    <label class="col-md-2 col-form-label" for="siswa">Nama Siswa</label>
                                                    <select class="form-control br-style" id="siswa" name="siswa">
                                                        <option value="">Pilih Nama Siswa</option>
                                                        @foreach($siswas as $siswa)
                                                            <option value="{{ $siswa->id }}" data-nis="{{ $siswa->nis }}">{{ $siswa->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('siswa')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-2 col-form-label" for="nis">NIS</label>
                                                    <input type="text" class="form-control" id="nis" name="nis" value="" readonly placeholder="Isi NIS Anda">
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-md-6 mt-1">
                                                    <label class="col-md-2 col-form-label" for="jenis">Metode Pembayaran</label>
                                                    <select class="form-control br-style" id="jenis" name="jenis">
                                                        <option value="">Pilih Metode Pembayaran</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="Cash">Cash</option>
                                                    </select>
                                                    @error('jenis')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <label class="col-md-2 col-form-label" for="petugas">Petugas</label>
                                                    <input type="text" class="form-control" name="petugas" value="{{ $loggedInUser->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-md-6 mt-4">
                                                    <label class="col-md-2 col-form-label" for="kelas">Kelas</label>
                                                    <select class="form-control br-style" id="kelas" name="kelas">
                                                        <option value="">Pilih Kelas</option>
                                                        @foreach($kelasList as $kelas)
                                                            <option value="{{ $kelas->kode_kelas }}">{{ $kelas->kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <label class="col-md-2 col-form-label" for="nominal">Nominal</label>
                                                    <input type="text" class="form-control" name="nominal" value="" placeholder="Isi Nominal Pembayaran">
                                                </div>
                                            </div>
                                            <div class="mt-5">
                                                <button class="btn btn-primary" type="submit"> Tambah </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            @include('back.layout.footer')
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#siswa').change(function(){
                var selectedOption = $(this).find('option:selected');
                var nis = selectedOption.data('nis');
                $('#nis').val(nis);
            });
        });
    </script>
</body>
</html>
@endsection
