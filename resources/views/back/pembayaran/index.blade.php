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
                            <h4 class="header-title mb-5">Table Data Pembayaran SPP</h4>

                            <div>
                                <a href="{{ route('Pembayaran.invoice') }}" class="btn btn-primary mb-4 mt-2" >Invoice</a>
                            </div>

                            <h4>Filter Data Pembayaran Siswa <small style="color: red">(Berdasarkan NIS)</small></h4>
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('Pembayaran') }}" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="nis" class="form-control" placeholder="Filter by NIS" value="{{ request('nis') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Spp Bulan</th>
                                        <th>Kelas</th>
                                        <th>Nominal</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                    <tr>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->kelas}}</td>
                                        <td>{{ $item->nominal }}</td>
                                        <td>
                                            @if($item->metode)
                                                {{ $item->metode->metode_pembayaran ?? '' }}
                                            @else
                                                Tidak Punya Pembayaran
                                            @endif
                                        </td>
                                        <td>
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
                                        <td>
                                            <!-- Hide the button when status is "lunas" -->
                                            @if($item->status != 'lunas')
                                                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->kode_pembayaran }}" class="btn btn-success">Bayar</a>
                                            @endif
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $item->kode_pembayaran }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{ $item->kode_pembayaran }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel{{ $item->kode_pembayaran }}">Konfirmasi Pembayaran Spp</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('Pembayaran.update', $item->kode_pembayaran) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="spp_bulan" class="form-label">Nama Siswa</label>
                                                                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa{{ $item->kode_pembayaran }}" value="{{ old('nama_siswa', $item->nama_siswa) }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="spp_bulan" class="form-label">Nis</label>
                                                                <input type="text" class="form-control" name="nis" id="nis{{ $item->kode_pembayaran }}" value="{{ old('nis', $item->nis) }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="spp_bulan" class="form-label">Spp Bulan</label>
                                                                <input type="text" class="form-control" name="spp_bulan" id="spp_bulan{{ $item->kode_pembayaran }}" value="{{ old('spp_bulan', $item->bulan) }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah" class="form-label">Nominal</label>
                                                                <input type="text" class="form-control" name="jumlah" id="jumlah{{ $item->kode_pembayaran }}" value="{{ old('jumlah', $item->nominal) }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jenis" class="form-label">Metode Pembayaran</label>
                                                                <select class="form-control" id="jenis{{ $item->kode_pembayaran }}" name="jenis">
                                                                    <option value="Cash" {{ old('jenis', $item->jenis) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                                    <option value="Transfer" {{ old('jenis', $item->jenis) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-control" name="status" id="status{{ $item->kode_pembayaran }}">
                                                                    <option value="lunas" {{ old('status', $item->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                                    <option value="belum lunas" {{ old('status', $item->status) == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="petugas" class="form-label">Nama Petugas</label>
                                                                <input type="text" class="form-control" name="petugas" id="petugas{{ $item->kode_pembayaran }}" value="{{ old('petugas', $loggedInUser->name) }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
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
