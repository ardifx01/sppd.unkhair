<!DOCTYPE html>
<html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link id='favicon' rel='shortcut icon' type='image/x-icon' href='{{ asset('images/') . pengaturan('logo') }}' />
        <title>{{ pengaturan('nama-sub-aplikasi') }}</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'
            integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>

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
        </style>
    </head>

    <body>
        <div class='container'>
            <div class="text-right mb-4">
                <b style="font-size:12px;">Diajukan Oleh : &nbsp;</b>
                <span class="badge bg-cyan">
                    <i class="fa fa-user"></i>
                    {{ $get->user?->name }}
                </span>
                <span class="badge bg-cyan">
                    <i class="fa fa-clock"></i>
                    {{ tgl_indo($get->created_at) }}
                </span>
            </div>
            <div class="table-responsive mb-0 border">
                <table class="table table-sm mb-0">
                    <tr>
                        <th class="text-right warna-warning" width="15%">Nomor SPPD :</td>
                        <td width="40%">
                            {{ $get->nomor_spd }}
                        </td>

                        <th class="text-right warna-warning" width="15%">Nama Pegawai :</td>
                        <td width="30%">
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
                        <td colspan="3">{{ $get->kode_mak ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="text-right warna-warning">Detail Alokasi Anggaran :</td>
                        <td colspan="3">{{ $get->detail_alokasi_anggaran ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right warna-info">Disetujui Oleh PPK :</td>
                        <td colspan="3">
                            {{ $get->reviwer?->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-right warna-info">Tanggal Persetujuan :</td>
                        <td colspan="3">
                            {{ tgl_indo($get->tanggal_review ?? '') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>

</html>
