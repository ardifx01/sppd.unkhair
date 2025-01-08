<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanStdController extends Controller
{
    //
    public function index()
    {
        $data = [
            'judul' => 'Laporan STD',
            'datatable' => []
        ];

        return view('backend.admin.std.laporan', $data);
    }
}
