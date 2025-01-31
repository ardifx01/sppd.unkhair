<!DOCTYPE html>
<html lang='en'>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <title>{{ pengaturan('nama-sub-aplikasi') }}</title>

        <style>
            .warna-success {
                background-color: #d4edda;
            }

            .warna-info {
                background-color: #d1ecf1;
            }

            .warna-warning {
                background-color: #fff3cd;
            }

            .warna-danger {
                background-color: #f8d7da;
            }

            .warna-primary {
                background-color: #cce5ff;
            }

            .nav-tabs .nav-link.active {
                font-weight: bold;
                background-color: transparent;
                border-bottom: 3px solid #dd0000;
                border-right: none;
                border-left: none;
                border-top: none;
            }

            .table-responsive {
                display: table;
            }
        </style>
    </head>

    <body>
        <div class='container mt-3'>
            <div class="card">
                <div class="card-body">
                    <div class="text-right mb-4">
                        <b style="font-size:12px;">Diajukan Oleh : &nbsp;</b>
                        <span class="badge badge-info">
                            <i class="fa fa-user"></i>
                            {{ $get->user?->name }}
                        </span>
                        <span class="badge badge-info">
                            <i class="fa fa-clock"></i>
                            {{ tgl_indo($get->created_at) }}
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th class="text-right warna-warning" width="15%">Nomor STD :</td>
                                <td width="40%">
                                    {{ $get->nomor_std }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Perihal Kegiatan :</td>
                                <td>{{ $get->kegiatan_std }}</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Nama Pegawai :</td>
                                <td>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($get->pegawai as $r)
                                            @if (count($get->pegawai) == 1)
                                                <li class="list-group-item p-0">
                                                    {{ $r->nama_pegawai }}
                                                </li>
                                            @break
                                        @endif
                                        <li class="list-group-item p-0">
                                            {{ $loop->index + 1 }}. {{ $r->nama_pegawai }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right warna-warning">Departemen/Unit :</td>
                            <td>{{ $get->departemen->departemen }}</td>
                        </tr>
                        <tr>
                            <th class="text-right warna-warning">Tanggal Dinas :</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0">
                                        <b>Dimulai: &nbsp;</b> {{ tgl_indo($get->tanggal_mulai_tugas, false) }}
                                    </li>
                                    <li class="list-group-item p-0">
                                        <b>Selesai: &nbsp;</b>{{ tgl_indo($get->tanggal_selesai_tugas, false) }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right warna-warning">Ttd. Pimpinan :</td>
                            <td>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0">
                                        {{ get_datajson($get->pimpinan_ttd, 'nama_pimpinan') }}
                                    </li>
                                    <li class="list-group-item p-0">
                                        <b>Jabatan:
                                            &nbsp;</b>{{ get_datajson($get->pimpinan_ttd, 'detail_jabatan') }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
                <dl>
                    <dt>Diverifikasi Oleh :</dt>
                    <dd>{{ $get->reviwer?->name ?? '-' }}</dd>

                    <dt>Tanggal Verifikasi :</dt>
                    <dd>
                        {{ tgl_indo($get->tanggal_review ?? '') }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</body>

</html>
