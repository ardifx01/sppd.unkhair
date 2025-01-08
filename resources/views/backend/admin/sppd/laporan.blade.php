@extends('layouts.backend')

@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $judul }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $judul }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content pl-2 pr-2">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $judul }}</h3>

                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-sm btn-primary">
                            <i class="fa fa-search"></i> Filter
                        </button>

                        <div class="table-responsive p-0 mb-2">
                            <table class="table table-condensed table-bordered table-sm" style="width: 100%"
                                id="id-datatable" style="font-size:10px;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Tanggal</th>
                                        <th class="text-left">Pegawai</th>
                                        <th class="text-left">Jabatan</th>
                                        <th class="text-left">Departemen/Unit</th>
                                        <th class="text-left">Tujuan</th>
                                        <th class="text-left">Keperluan</th>
                                        <th class="text-left">Lama</th>
                                        <th class="text-left">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
