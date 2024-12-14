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
                    <form action="{{ route('admin.pegawai.act-import') }}" method="post" class="form-horizontal">
                        <div class="card-header">
                            <h3 class="card-title">{{ $judul }}</h3>

                            <div class="card-tools"></div>
                        </div>

                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="kategori" id="kategori" value="{{ $kategori }}">

                            <div class="callout callout-info mb-2">
                                <b>Petunjun pengisian:</b><br>
                                1. Silahkan lengkapi kolom yang mengandung tanda bintang (<span
                                    class="text-danger">*</span>). <br>
                                2. Jangan memasukan simbol-simbol tertentu. <br>
                                3. Maksimal data yang di proses sebanyak 100 data.
                            </div>

                            @if (session('galat'))
                                {{-- @dump(session('galat'), session('galat')['data']) --}}
                                <div class="row mt-2">
                                    <div class="col-md-12 col-md-offset-1">
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                            @if (array_key_exists('data', session('galat')))
                                                @foreach (session('galat')['data']->all() as $error)
                                                    {{ $error }}<br>
                                                @endforeach
                                            @endif

                                            @if (array_key_exists('kategori', session('galat')))
                                                @foreach (session('galat')['kategori']->all() as $error)
                                                    {{ $error }}<br>
                                                @endforeach
                                            @endif

                                            @if (array_key_exists('peserta', session('galat')))
                                                @foreach (session('galat')['peserta'] as $val)
                                                    @foreach ($val['errors']->all() as $error)
                                                        Data baris {{ $val['baris'] }} - {{ $error }} <br>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="table-responsive p-0 mt-4">
                                <input type="hidden" name="data" id="json-peserta" value="">
                                <div id="tbl-peserta"></div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="btn-submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Simpan Data (0)
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @push('style')
        <link rel="stylesheet" media="screen" href="{{ asset('adminlte3/plugins/handsontable/handsontable.full.min.css') }}">
    @endpush

    @push('script')
        <script src="{{ asset('adminlte3/plugins/handsontable/handsontable.full.min.js') }}"></script>

        <script>
            var firstLoad = true;
            var peserta_overload = false;
            var data =
                @if (old('data'))
                    {!! old('data') !!}
                @else
                    []
                @endif ;

            const hot = new Handsontable(document.getElementById('tbl-peserta'), {
                startRows: 5,
                startCols: 16,
                rowHeaders: true,
                manualColumnResize: true, // true user bisa lebar/kecilkan kolom
                maxRows: 100,
                dataSchema: {
                    nik: null,
                    nama_pegawai: null,
                    jk: null,
                    kategori: "{{ $kategori_str }}",
                    nip: null,
                    tempat_lahir: null,
                    tanggal_lahir: null,
                    hp: null,
                    jabatan: null
                },

                contextMenu: true,
                data: data,
                height: 500,
                stretchH: 'all',
                minSpareCols: 1,
                minSpareRows: 100,
                language: 'id',
                columns: [{
                        type: 'text',
                        data: 'nik',
                        title: 'NIK <span class="text-danger">*</span>',
                        width: 130,
                    },
                    {
                        type: 'text',
                        data: 'nama_pegawai',
                        title: 'NAMA PEGAWAI <span class="text-danger">*</span>',
                        width: 200
                    },
                    {
                        type: 'dropdown',
                        data: 'jk',
                        title: 'JK',
                        width: 50,
                        source: ['L', 'P']
                    },
                    {
                        type: 'text',
                        data: 'kategori',
                        title: 'PEGAWAI',
                        readOnly: true,
                        width: 100
                    },
                    {
                        type: 'text',
                        data: 'nip',
                        title: 'NIP',
                        width: 130
                    },
                    {
                        type: 'text',
                        data: 'tempat_lahir',
                        title: 'TEMPAT LAHIR',
                        width: 100
                    },
                    {
                        type: 'text',
                        data: 'tanggal_lahir',
                        title: 'TANGGAL LAHIR',
                        width: 100
                    },
                    {
                        type: 'text',
                        data: 'hp',
                        title: 'NOMOR HP',
                        width: 100
                    },
                    {
                        type: 'text',
                        data: 'jabatan',
                        title: 'JABATAN',
                        width: 250
                    }
                ],
                afterChange: function(change, source) {
                    //alert(source);
                    summary(this.getData());
                },
                afterRemoveRow: function() {
                    summary(this.getData());
                }
            });

            function summary(data) {
                if (!data) {
                    return;
                }
                var count = 0;
                for (var i = 0; i < data.length; i++) {
                    if (data[i].nik && data[i].nama_pegawai) {
                        count++;
                    }
                }

                if (count) {
                    $('#json-peserta').val(JSON.stringify(data));
                }

                $('#btn-submit').html('<i class="fa fa-save"></i> Simpan Data (' + count + ')');
                console.log(count);
            }
        </script>
    @endpush
@endsection
