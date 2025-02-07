<!DOCTYPE html>
<html>

    <head>
        <style>
            body {
                font-family: Times;
            }

            .kolom {
                border: 1px solid black;
                text-align: left;
                vertical-align: top;
                padding: 4px;
            }

            .kolom2 {
                border: 1px solid black;
                text-align: left;
                vertical-align: top;
            }

            .wrapper-page {
                page-break-after: always;
            }

            .wrapper-page:last-child {
                page-break-after: avoid;
            }
        </style>
    </head>

    {{-- <body style="border:1px solid #000"> --}}

    <body>
        <div class="wrapper-page">
            <page_header>
                <table width="65%" align="center">
                    <tr>
                        <td width="10%">
                            <center>
                                <img src="{{ get_image(public_path('images/logo.png')) }}" alt=""
                                    style="width:95px; height:90px;">
                            </center>
                        </td>
                        <td width="90%" style="text-align:center">
                            <span style="font-size:20px;">
                                KEMENTERIAN PENDIDIKAN, SAINS <br> DAN TEKNOLOGI
                            </span>
                            <br>
                            <span style="font-size:18px; font-weight:bold;">UNIVERSITAS KHAIRUN</span> <br>
                            <span style="font-size:14px;">
                                Jalan Jusuf Abdurrahman Kampus Gambesi Kode Pos 97719 Ternate Selatan
                            </span> <br>
                            <span style="font-size:14px;">
                                Laman: <a href="https://www.unkhair.ac.id">www.unkhair.ac.id</a> / Email:
                                <u>admin@unkhair.ac.id</a>
                            </span>
                        </td>
                    </tr>
                </table>
                <hr>
            </page_header>

            <br>
            <center>
                <span style="font-size:16px;">
                    <u>Laporan Pengajuan SPPD</u>
                </span> <br>
                <span style="font-size:15px;">
                    <b>{{ $tanggal }}</b>
                </span>
            </center>

            <br>

            <table width="100%" style="font-size:12px; margin-top:5px; border-collapse: collapse;">
                <tr style="background-color:lightgray">
                    <th class="kolom">No</th>
                    <th class="kolom">Nomor SPPD</th>
                    <th class="kolom">Kegiatan SPPD</th>
                    <th class="kolom">Tanggal SPPD</th>
                    <th class="kolom">Tujuan</th>
                    <th class="kolom">Pegawai</th>
                    <th class="kolom">Departemen/Unit</th>
                    <th class="kolom">Nomor MAK</th>
                    <th class="kolom">Detail Alokasi</th>
                    <th class="kolom">Nilai Pencairan</th>
                    <th class="kolom">Dibuat</th>
                </tr>
                @foreach ($listsppd as $row)
                    <tr>
                        <td class="kolom">{{ $loop->index + 1 }}</td>
                        <td class="kolom">{{ $row->nomor_spd }}</td>
                        <td class="kolom">{{ $row->kegiatan_spd }}</td>
                        <td class="kolom">{{ tgl_indo($row->tanggal_spd, false) }}</td>
                        <td class="kolom">{{ $row->tujuan }}</td>
                        <td class="kolom">{{ $row->nama_pegawai }}</td>
                        <td class="kolom">{{ $row->departemen->departemen ?? '-' }}</td>
                        <td class="kolom">{{ $row->kode_mak }}</td>
                        <td class="kolom">{{ $row->detail_alokasi_anggaran }}</td>
                        <td class="kolom">{{ rupiah($row->nilai_pencairan) }}</td>
                        <td class="kolom">{{ tgl_indo($row->created_at, false) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </body>

</html>
