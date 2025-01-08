<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanSppdController extends Controller
{
    //
    public function index()
    {
        $data = [
            'judul' => 'Laporan SPPD',
            'datatable' => []
        ];

        return view('backend.admin.sppd.laporan', $data);
    }
}
