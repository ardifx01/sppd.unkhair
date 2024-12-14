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
                <table width="100%" align="center">
                    <tr>
                        <td width="20%">
                            <center>
                                <img src="{{ public_path('images/logo.jpg') }}" alt="" style="width:90px;">
                            </center>
                        </td>
                        <td width="80%" style="text-align:center">
                            <span style="font-size:17px; font-weight:bold;">KEMENTERIAN PENDIDIKAN, SAIN DAN
                                TEKNOLOGI</span>
                            <br>
                            <span style="font-size:17px; font-weight:bold;">UNIVERSITAS KHAIRUN</span> <br>
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

            <table width="40%" align="right" border="0" style="font-size:14px;">
                <tr>
                    <td width="30%">Lembar Ke</td>
                    <td width="70%">: (Satu) 1</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>: {{ $sppd->nomor_spd }}</td>
                </tr>
            </table>

            <br>
            <center>
                <span style="font-size:14px;">
                    SURAT PERJALANAN DINAS (SPD)
                </span>
            </center>

            <table width="100%" style="font-size:14px; border-collapse: collapse;">
                <tr>
                    <td width="5%" class="kolom">1</td>
                    <td width="40%" class="kolom">
                        Pejabat Pembuat Komitmen
                    </td>
                    <td width="55%" class="kolom" colspan="2">
                        Rektor Universitas Khairun
                    </td>
                </tr>
                <tr>
                    <td class="kolom">2</td>
                    <td class="kolom">
                        Nama/NIP Pegawai yang melaksanakan Perjalanan Dinas
                    </td>
                    <td class="kolom" colspan="2">
                        {{ $sppd->pegawai->nama_pegawai }}
                    </td>
                </tr>
                <tr>
                    <td class="kolom">3</td>
                    <td class="kolom">
                        a. Pangkat dan Golongan <br>
                        b. Jabatan/Instansi <br>
                        b. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td class="kolom" colspan="2">
                        a. - <br>
                        b. {{ $sppd->pegawai->jabatan }} <br>
                        c. -
                    </td>
                </tr>
                <tr>
                    <td class="kolom">4</td>
                    <td class="kolom">
                        Maksud Perjalanan Dinas
                    </td>
                    <td class="kolom" colspan="2">
                        {{ $sppd->kegiatan_spd }}
                    </td>
                </tr>
                <tr>
                    <td class="kolom">5</td>
                    <td class="kolom">
                        Alat angkutan yang dipergunakan
                    </td>
                    <td class="kolom" colspan="2">
                        {{ $sppd->angkutan }}
                    </td>
                </tr>
                <tr>
                    <td class="kolom"></td>
                    <td class="kolom">
                        a. Tempat Berangkat <br>
                        b. Tempat Tujuan
                    </td>
                    <td class="kolom" colspan="2">
                        a. {{ $sppd->berangakat }} <br>
                        b. {{ $sppd->tujuan }}
                    </td>
                </tr>
                <tr>
                    <td class="kolom">6</td>
                    <td class="kolom">
                        a. Lamanya Perjalanan Dinas <br>
                        b. Tanggal Berangkat <br>
                        c. Tanggal harus kembali/tiba di tempat baru *)
                    </td>
                    <td class="kolom" colspan="2">
                        a. {{ $sppd->lama_pd }} hari <br>
                        b. {{ tgl_indo($sppd->tanggal_berangakat, false) }} <br>
                        c. {{ tgl_indo($sppd->tanggal_kembali, false) }}
                    </td>
                </tr>
                <tr>
                    <td class="kolom">7</td>
                    <td class="kolom">
                        Pengikut: Nama
                    </td>
                    <td class="kolom">
                        Tanggal Lahir
                    </td>
                    <td class="kolom">
                        Keterangan
                    </td>
                </tr>
                <tr>
                    <td class="kolom"></td>
                    <td class="kolom">
                        1. <br>
                        2.
                    </td>
                    <td class="kolom" colspan="2">

                    </td>
                </tr>
                <tr>
                    <td class="kolom">8</td>
                    <td class="kolom">
                        Pembebanan Anggaran <br>
                        a. Instansi <br>
                        b. Akun
                    </td>
                    <td class="kolom" colspan="2">
                        <br>
                        a. <br>
                        b.
                    </td>
                </tr>
                <tr>
                    <td class="kolom">9</td>
                    <td class="kolom">
                        Keterangan Lain-Lainnya <br> <br>
                    </td>
                    <td class="kolom" colspan="2">

                    </td>
                </tr>
            </table>
            <table width="100%" style="font-size:14px;">
                <tr>
                    <td width="60%" style="vertical-align: top">
                        Coret yang tidak perlu
                        {!! str_repeat('<br>', 8) !!}
                        Tembusan: <br>
                        1. Bendahara Universitas Khairun <br>
                        2. Kepala KPPN Ternate
                    </td>
                    <td width="40%" style="vertical-align: top">
                        <br>
                        Dikeluarkan di Ternate <br>
                        Tanggal, {{ tgl_indo(now(), false) }} <br> <br>
                        Pejabat Pembuat Komitmen
                        {!! str_repeat('<br>', 5) !!}
                        {{ get_datajson($sppd->pejabat_ppk, 'nama_ppk') }} <br>
                        NIP: {{ get_datajson($sppd->pejabat_ppk, 'nip') }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="wrapper-page">
            <table width="100%" style="font-size:14px; border-collapse: collapse;">
                <tr>
                    <td width="45%" class="kolom2"></td>
                    <td width="55%" class="kolom2">
                        <table width="100%">
                            <tr>
                                <td width="5%">I.</td>
                                <td width="45%">Berangkat dari</td>
                                <td width="50%"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>(Tempat Kedudukan)</td>
                                <td>: {{ $sppd->berangakat }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Ke</td>
                                <td>: {{ $sppd->tujuan }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pada tanggal</td>
                                <td style="text-align:right;">{{ date('Y') }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    Kepala
                                    <br>
                                    <br>
                                    <br>
                                    {{ get_datajson($sppd->pejabat_ppk, 'nama_ppk') }} <br>
                                    NIP: {{ get_datajson($sppd->pejabat_ppk, 'nip') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $romawi = [
                            1 => 'II',
                            2 => 'III',
                            3 => 'IV',
                            4 => 'V',
                        ];
                    @endphp
                    <tr>
                        <td class="kolom2">
                            <table width="100%">
                                <tr>
                                    <td width="7%">{{ $romawi[$i] }}</td>
                                    <td width="40%">Tiba di</td>
                                    <td width="52%">:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pada tanggal</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Kepala</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2" style="padding-top:73px;">
                                        ({{ str_repeat('.', 60) }})<br>
                                        NIP:
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="kolom2">
                            <table width="100%">
                                <tr>
                                    <td width="5%"></td>
                                    <td width="45%">Berangkat dari</td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>(Tempat Kedudukan)</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Ke</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pada tanggal</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2">
                                        Kepala
                                        <br>
                                        <br>
                                        <br>
                                        ({{ str_repeat('.', 60) }})<br>
                                        NIP:
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endfor

                <tr>
                    <td class="kolom2">
                        <table width="100%">
                            <tr>
                                <td width="7%">VI.</td>
                                <td width="40%">Tiba di</td>
                                <td width="52%">:</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>(Tempat Kedudukan)</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pada tanggal</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    Kepala
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    ({{ get_datajson($sppd->pejabat_ppk, 'nama_ppk') }}) <br>
                                    NIP: {{ get_datajson($sppd->pejabat_ppk, 'nip') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="kolom2">
                        <table width="100%">
                            <tr>
                                <td width="5%"></td>
                                <td width="95%">
                                    Telah diperiksa dengan keterangan bahwa perjalanan
                                    tersebut atas perintahnya dan semata-mata untuk
                                    kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Pejabat Pembuat Komitmen</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding-top:56px;">
                                    ({{ get_datajson($sppd->pejabat_ppk, 'nama_ppk') }}) <br>
                                    NIP: {{ get_datajson($sppd->pejabat_ppk, 'nip') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="kolom2">
                        <table width="100%">
                            <tr>
                                <td width="5%">VII.</td>
                                <td width="95%">
                                    Catatan Lain-Lain
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="kolom2">
                        <table width="100%">
                            <tr>
                                <td width="5%" style="vertical-align: top">VIII.</td>
                                <td width="95%" style="vertical-align: top">
                                    PERHATIAN : <br>
                                    KPA yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang
                                    mengesahkan
                                    tanggal berangkat/tiba serta bendahara pengeluaran bertanggungjawab berdasarkan
                                    peraturan-peraturan
                                    Keuangan Negara apabila menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>

</html>
