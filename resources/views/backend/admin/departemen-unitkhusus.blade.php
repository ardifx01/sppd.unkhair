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
                        <h3 class="card-title">{{ $judul }}
                            <i class="fa fa-angle-right"></i>
                            <u><i>{{ $unitpusat }}</i></u>
                        </h3>

                        <div class="card-tools"></div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-sm btn-primary" onclick="add('Tambah Sub Departemen')">
                            <i class="fa fa-plus"></i> Tambah Data
                        </button>

                        <div class="table-responsive p-0 mb-2">
                            <table class="table table-condensed table-bordered" style="width: 100%"
                                id="{{ $datatable['id_table'] }}">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Departemen</th>
                                        <th>Unit Bagian</th>
                                        <th>Lokasi</th>
                                        <th>
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <livewire:master.unitkhusus params="{{ $params }}">

            <!-- /.content -->
            @push('script')
                <script>
                    function add(title) {
                        Livewire.dispatch('add-data', {
                            title: title
                        });
                    }

                    function edit(departemen_id) {
                        Livewire.dispatch('edit-data', {
                            departemen_id: departemen_id
                        });
                    }
                </script>
            @endpush
    </div>
@endsection
