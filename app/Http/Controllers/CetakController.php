<?php

namespace App\Http\Controllers;

use App\Models\SuratPerjalananDinas;
use App\Models\SuratTugasDinas;
use PDF;

class CetakController extends Controller
{
    public function sppd($params)
    {
        $params = decode_arr($params);
        if (!$params) {
            abort(403);
        }

        $sppd = SuratPerjalananDinas::with(['pegawai', 'departemen'])->where('id', $params['sppd_id'])->first();
        // dd($sppd);
        $data = ['sppd' => $sppd];
        $pdf = PDF::loadView('pdf.cetak-sppd', $data)->setPaper('legal', 'portrait');


        $judul = date('Ymd') . ' - ' . 'Surat Perjalanan Dinas' . '.pdf';

        //menampilkan output beupa halaman PDF
        return $pdf->stream($judul);
    }

    public function std($params)
    {
        $params = decode_arr($params);
        if (!$params) {
            abort(403);
        }

        $std = SuratTugasDinas::with(['pegawai', 'departemen'])->where('id', $params['stugas_id'])->first();

        $data = ['std' => $std];
        $pdf = PDF::loadView('pdf.cetak-std', $data)->setPaper('a4', 'portrait');


        $judul = date('Ymd') . ' - ' . 'Surat Tugas Dinas' . '.pdf';

        //menampilkan output beupa halaman PDF
        return $pdf->stream($judul);
    }
}
