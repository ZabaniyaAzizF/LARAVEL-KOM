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
                                <li class="breadcrumb-item active">Form Pembuatan</li>
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
                                                    <label class="col-md-2 col-form-label" for="simpleinput">Kode Pembayaran</label>
                                                    <?php
                                                    $kodepembayaran = autonumber('pembayaran', 'kode_pembayaran', 6, 'KPS');
                                                    ?>
                                                    <input class="form-control" name="kode_pembayaran" readonly id="kode_pembayaran" type="text" value="<?= $kodepembayaran ?>">
                                                @error('kode_kelas')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-md-6">
                                                    <label class="col-md-2 col-form-label" for="nis">NIS</label>
                                                    <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                                                    @error('nis')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-2 col-form-label" for="nama_siswa">Nama Siswa</label>
                                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" readonly>
                                                    @error('nama_siswa')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-md-6 mt-5">
                                                    <label class="col-md-2 col-form-label" for="kelas">Kelas</label>
                                                    <input type="text" class="form-control" id="kelas" name="kelas" readonly>
                                                    @error('kelas')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-5">
                                                    <label class="col-md-2 col-form-label" for="jenis"> Jenis Pembayaran</label>
                                                    <select class="form-control br-style" id="jenis" name="jenis">
                                                        <option value="">Pilih Jenis Pembayaran</option>
                                                        @foreach($metodeList as $metode)
                                                            <option value="{{ $metode->kode_metode }}">{{ $metode->metode_pembayaran }} - {{ $metode->jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="mb-2 row">
                                                <div class="col-md-6 mt-4">
                                                    <label class="col-md-2 col-form-label" for="nominal">Nominal</label>
                                                    <input type="text" class="form-control" name="nominal" placeholder="Isi Nominal Pembayaran">
                                                    @error('nominal')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mt-4">
                                                    <label class="col-md-2 col-form-label" for="bulan">Bulan</label>
                                                    <select class="form-control br-style" id="bulan" name="bulan">
                                                        <option value="">Pilih Bulan</option>
                                                        <option value="Januari">Januari</option>
                                                        <option value="Februari">Februari</option>
                                                        <option value="Maret">Maret</option>
                                                        <option value="April">April</option>
                                                        <option value="Mei">Mei</option>
                                                        <option value="Juni">Juni</option>
                                                        <option value="Juli">Juli</option>
                                                        <option value="Agustus">Agustus</option>
                                                        <option value="September">September</option>
                                                        <option value="Oktober">Oktober</option>
                                                        <option value="November">November</option>
                                                        <option value="Desember">Desember</option>
                                                    </select>
                                                    @error('bulan')
                                                        <small>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Di bagian form -->
                                            <div class="mb-2 row">
                                                <div class="col-md-6">
                                                    <label class="col-md-2 col-form-label" for="petugas">Petugas</label>
                                                    <input type="text" class="form-control" id="petugas" name="petugas" value="{{ Auth::user()->name }}" readonly>
                                                    <!-- Anda bisa menggunakan Auth::user()->name atau informasi lain sesuai kebutuhan -->
                                                    @error('petugas')
                                                        <small>{{ $message }}</small>
                                                    @enderror
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
        $(document).ready(function() {
        // // Data nominal berdasarkan kode metode
        // var nominalByMetode = @json($nominalByMetode);

        // // Ketika jenis pembayaran dipilih
        // $('#jenis').on('change', function() {
        //     var metode_kode = $(this).val();
        //     if (metode_kode) {
        //         var nominal = nominalByMetode[metode_kode];
        //         if (nominal) {
        //             $('#nominal').val(nominal);
        //         } else {
        //             alert('Nominal tidak ditemukan');
        //             $('#nominal').val('');
        //         }
        //     } else {
        //         $('#nominal').val('');
        //     }
        // });

            // Ketika NIS siswa dipilih
            $('#nis').on('change', function() {
                var nis = $(this).val();
                if (nis) {
                    var siswas = @json($siswas);
                    var siswa = siswas.find(siswa => siswa.nis === nis);
                    if (siswa) {
                        $('#nama_siswa').val(siswa.nama_siswa);
                        $('#kelas').val(siswa.kelas.kelas + ' (' + siswa.kelas.tingkatan.tingkatan + ' - ' + siswa.kelas.ajaran.tahun_ajaran + ')');
                    } else {
                        alert('Data siswa tidak ditemukan');
                        $('#nama_siswa').val('');
                        $('#kelas').val('');
                    }
                } else {
                    $('#nama_siswa').val('');
                    $('#kelas').val('');
                }
            });
        });
    </script>
    
</body>
</html>
@endsection
