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
                        <div class="table-responsive p-0 mb-2">
                            <table class="table table-condensed table-bordered" style="width: 100%"
                                id="{{ $datatable['id_table'] }}">
                                <thead class="warna-warning">
                                    <tr>
                                        <th style="vertical-align: middle">#</th>
                                        <th class="text-left" style="vertical-align: middle">
                                            Kegiatan STD
                                        </th>
                                        <th class="text-left">Tanggal STD</th>
                                        <th class="text-left" style="vertical-align: middle">Pegawai</th>
                                        <th class="text-left" style="vertical-align: middle">
                                            Departemen/Unit
                                        </th>
                                        <th class="text-left">Status</th>
                                        <th style="vertical-align: middle">
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

        <livewire:std.review-std />
        <livewire:std.detail-std />

        <!-- /.content -->
        @push('script')
            <script>
                function detail(params) {
                    Livewire.dispatch('detail-std', {
                        params: params
                    });
                }

                function review(params) {
                    Livewire.dispatch('review-pengajuan-std', {
                        params: params
                    });
                }
            </script>
        @endpush
    </div>
@endsection
