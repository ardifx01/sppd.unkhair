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
                                <th class="text-right warna-warning">Nomor SPPD :</td>
                                <td>
                                    {{ $get->nomor_spd }}
                                </td>

                                <th class="text-right warna-warning">Nama Pegawai :</td>
                                <td>
                                    {{ $get->pegawai->nama_pegawai }} <br>
                                    NIP: {{ $get->pegawai->nip ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Perihal Kegiatan :</td>
                                <td>{{ $get->kegiatan_spd }}</td>

                                <th class="text-right warna-warning">Departemen/Unit :</td>
                                <td>{{ $get->departemen->departemen }}</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Berangkat Dari :</td>
                                <td>{{ $get->berangakat }}</td>

                                <th class="text-right warna-warning">Lama Perjalanan :</td>
                                <td>{{ $get->lama_pd }} hari</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Tujuan Ke :</td>
                                <td>{{ $get->tujuan }}</td>

                                <th class="text-right warna-warning">Tanggal Berangkat :</td>
                                <td>
                                    {{ tgl_indo($get->tanggal_berangakat, false) }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Transportasi :</td>
                                <td>{{ $get->angkutan }}</td>

                                <th class="text-right warna-warning">Tanggal Kembali :</td>
                                <td>
                                    {{ tgl_indo($get->tanggal_kembali, false) }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Kode MAK :</td>
                                <td>{{ $get->kode_mak ?? '' }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Detail Alokasi Anggaran :</td>
                                <td>{{ $get->detail_alokasi_anggaran ?? '' }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <dl>
                        <dt>Disetujui Oleh PPK :</dt>
                        <dd>{{ $get->reviwer?->name ?? '-' }}</dd>

                        <dt>Tanggal Persetujuan :</dt>
                        <dd>
                            {{ tgl_indo($get->tanggal_review ?? '') }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </body>

</html>
