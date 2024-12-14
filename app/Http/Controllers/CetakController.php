<?php

namespace App\Http\Controllers;

use App\Models\SuratPerjalananDinas;

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


        $judul = 'SPPD - ' . $sppd->pegawai->nama_pegawai . '.pdf';

        //menampilkan output beupa halaman PDF
        return $pdf->stream($judul);
    }
}
