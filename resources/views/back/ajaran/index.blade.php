@extends('back.layout.template')
@section('title', Auth::user()->name . ' - Tahun Ajaran')
@section('content')
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

    
<!-- Mirrored from myrathemes.com/dashtrap/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 May 2024 04:07:18 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
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

                                        <a href="{{ route('Ajaran.tambah')}}" class="btn btn-primary mb-4 mt-2">Tambah Data</a>
                                        <a href="{{ route('Ajaran.invoice') }}" class="btn btn-primary mb-4 mt-2" >Invoice</a>

                                        <table class="table" >
                                            <thead>
                                              <tr>
                                                <th>kode Ajaran</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Status</th>
                                                <th >Aksi</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ajaran as $item)
                                              <tr>
                                                <th>{{$item->kode_ajaran}}</th>
                                                <th>{{$item->tahun_ajaran}}</th>
                                                <th>                                            
                                                    <div class="col-md-12">
                                                    @php
                                                    $statusColor = 'secondary'; // Default color
                                                
                                                    // Set color based on payment status
                                                    if ($item->status == 'aktif') {
                                                        $statusColor = 'success';
                                                    } elseif ($item->status == 'tidak aktif') {
                                                        $statusColor = 'danger';
                                                    }
                                                    @endphp
                                                
                                                    <span class="badge badge-outline rounded-pill bg-{{ $statusColor }}">
                                                        {{ $item->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                    </div>
                                                </th>
                                                <td>
                                                    <a href="{{ route('Ajaran.edit',$item->kode_ajaran)}}" class="btn btn-primary shadow btn-xs sharp me-1 mb-1">Edit</a>
                                                    <br>
                                                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $item->kode_ajaran }}" class="btn btn-danger shadow btn-xs sharp me-1">Hapus</a>
                                                </td>
                                              </tr>
                                              <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $item->kode_ajaran }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Delete data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda Yakin Ingin Menghapus Data <b style="color: rgb(0, 17, 255);">{{ $item->tahun_ajaran }}</b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('Ajaran.delete',$item->kode_ajaran)}}" method="POST">
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

<!-- Mirrored from myrathemes.com/dashtrap/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 May 2024 04:07:26 GMT -->
</html>
@endsection
