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
                        <fieldset class="border p-2 mb-3 shadow-sm">
                            <legend class="float-none w-auto p-2">Filter Data</legend>
                            <form class="form-horizontal ml-2">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Kategori Pegawai</label>
                                    <div class="col-sm-3">
                                        <select name="kategori" class="form-control" id="kategori">
                                            <option value="">-- All --</option>
                                            @foreach ($kategori as $key => $value)
                                                <option value="{{ encode_arr(['kategori' => $key]) }}"
                                                    {{ data_params(old('kategori'), 'kategori') == $key ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-7" id="tombol-tambah" style="display:none;">
                                        <button type="button" class="btn btn-info" onclick="add_pegawai()">
                                            <i class="fa fa-user-plus"></i> Tambah Pegawai
                                        </button>

                                        <button type="button" class="btn btn-primary tombol-import">
                                            <i class="fa fa-users"></i> Tambah Masal
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </fieldset>

                        <div class="table-responsive p-0 mb-2">
                            <table class="table table-condensed table-bordered" style="width: 100%"
                                id="{{ $datatable2['id_table'] }}">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Nama Pegawai</th>
                                        <th class="text-left">JK</th>
                                        <th class="text-left">TTL</th>
                                        <th class="text-left">Jabatan</th>
                                        <th class="text-left">Depatemen/Unit</th>
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

        <livewire:master.pegawai />

        <!-- /.content -->
        @push('script')
            <script type="text/javascript">
                let url_importdata = "{{ route('admin.pegawai.import', '') }}";
                let kategori = "";
                var table;
                $(function() {
                    table = $("#{{ $datatable2['id_table'] }}").DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ $datatable2['url'] }}",
                            data: function(d) {
                                d.jalur = $('#jalur').val(),
                                    d.kategori = $('#kategori').val()
                            }
                        },
                        columns: [
                            @foreach ($datatable2['columns'] as $row)
                                {
                                    data: "{{ $row['data'] }}",
                                    name: "{{ $row['name'] }}",
                                    orderable: {{ $row['orderable'] }},
                                    searchable: {{ $row['searchable'] }}
                                },
                            @endforeach
                        ]
                    });

                    $('#tombol-tambah').hide();

                    $('#kategori').change(function() {
                        table.draw();
                        kategori = $('#kategori').val();
                        if ($('#kategori').val() == "-") {
                            $('#tombol-tambah').hide();
                            $("a.tombol-import").attr("href", "");
                        } else {
                            $('#tombol-tambah').show();
                            $("a.tombol-import").attr("href", url_importdata + "/" + kategori);
                        }
                    });

                    if ($('#kategori').val()) {
                        kategori = $('#kategori').val();
                        if ($('#kategori').val() == "-") {
                            $('#tombol-tambah').hide();
                            $("a.tombol-import").attr("href", "");
                        } else {
                            $('#tombol-tambah').show();
                            $("a.tombol-import").attr("href", url_importdata + "/" + kategori);
                        }
                    }
                });

                window.addEventListener('livewire:init', event => {
                    Livewire.on('load-datatable2', (event) => {
                        table.draw();
                    });
                });

                function add_pegawai() {
                    var kategori_pegawai = $('#kategori').val();
                    Livewire.dispatch('add-data', {
                        kategori_pegawai: kategori_pegawai
                    });
                }

                function edit(pegawai_id) {
                    Livewire.dispatch('edit-data', {
                        pegawai_id: pegawai_id
                    });
                }
            </script>
        @endpush
    </div>
@endsection
