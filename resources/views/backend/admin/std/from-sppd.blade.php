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
                            <table class="table table-condensed table-sm table-bordered" style="width: 100%"
                                id="id-datatable">
                                <thead class="warna-warning">
                                    <tr>
                                        <th style="vertical-align: middle">#</th>
                                        <th class="text-left" style="vertical-align: middle">
                                            Kegiatan STD
                                        </th>
                                        <th class="text-left">Tanggal Dinas</th>
                                        <th class="text-left" style="vertical-align: middle">Pegawai</th>
                                        <th class="text-left" style="vertical-align: middle">Dibuat</th>
                                        <th style="vertical-align: middle">
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $row)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @php
                                                    $str = '<ul class="list-group list-group-flush">';
                                                    $str .=
                                                        '<li class="list-group-item p-0">' .
                                                        Str::limit($row->kegiatan_std, 60, ' ...') .
                                                        '</li>';
                                                    $str .=
                                                        '<li class="list-group-item p-0">Nomor: ' .
                                                        $row->nomor_std .
                                                        '</li>';
                                                    $str .= '</ul>';
                                                    echo $str;
                                                @endphp
                                            </td>
                                            <td>{{ str_tanggal_dinas($row->tanggal_mulai_tugas, $row->tanggal_selesai_tugas) }}
                                            </td>
                                            <td>
                                                @php
                                                    $str = '<ul class="list-group list-group-flush">';
                                                    foreach ($row->pegawai as $index => $r) {
                                                        if (count($row->pegawai) == 1) {
                                                            $str .=
                                                                '<li class="list-group-item p-0">' .
                                                                $r->nama_pegawai .
                                                                '</li>';
                                                            break;
                                                        }

                                                        $nomor = $index + 1;
                                                        if ($nomor <= 3) {
                                                            $str .=
                                                                '<li class="list-group-item p-0">' .
                                                                $nomor .
                                                                '. ' .
                                                                $r->nama_pegawai .
                                                                '</li>';
                                                        } else {
                                                            $str .=
                                                                '<li class="list-group-item p-0 text-muted">&nbsp;... </li>';
                                                            break;
                                                        }
                                                    }
                                                    $str .= '</ul>';
                                                    echo $str;
                                                @endphp
                                            </td>
                                            <td>{{ tgl_indo($row->created_at) }}</td>
                                            <td>
                                                @php
                                                    $edit = "lengkapi('" . encode_arr(['stugas_id' => $row->id]) . "')";
                                                    $actionBtn =
                                                        '
                    <center>
                        <button type="button" onclick="' .
                                                        $edit .
                                                        '" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Lengkapi</button>
                    </center>';
                                                    echo $actionBtn;
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- /.content -->
        @push('script')
            <script>
                function lengkapi(params) {
                    return location.href = "{{ route('admin.std.lengkapi', '') }}/" + params;
                }
            </script>
        @endpush
    </div>
@endsection
