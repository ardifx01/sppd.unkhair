<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\SuratPerjalananDinas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WebController extends Controller
{
    public function index()
    {
        return view('layouts.frontent2');
    }

    public function lihatdokumen($params)
    {
        if (!$params) {
            abort(404);
            exit();
        }

        $params = decode_arr($params);
        if (!$params) {
            abort(403);
            exit();
        }

        // dd($params);

        $berkas = Berkas::where('id', $params['berkas_id'])->first();
        if ($berkas && in_array(strtolower($berkas->type_berkas), ['jpg', 'jpeg'])) {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <link id='favicon' rel='shortcut icon' type='image/x-icon' href='" . asset('images/') . pengaturan('logo') . "' />
                    <title>" . pengaturan('nama-sub-aplikasi') . "</title>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>

                    <style>
                    .avatar {
                        /*    background-color: #7d7d7d;*/
                        border: 2px solid #7d7d7d;
                        padding: 2px;
                    }
                    </style>
                </head>
                <body>
                <div class='container'>
                    <center>
                        <p>
                            <img src='" . $berkas->url_berkas . "' alt='blgo image' class='avatar mt-5'>
                        </p>
                    </center>
                </div>
                </body>
            </html>
            ";
            exit();
        } elseif ($berkas && strtolower($berkas->type_berkas) == 'pdf') {
            echo "
            <!DOCTYPE html>
            <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <link id='favicon' rel='shortcut icon' type='image/x-icon' href='" . asset('images/') . pengaturan('logo') . "' />
                    <title>" . pengaturan('nama-sub-aplikasi') . "</title>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>

                    <style>
                    .avatar {
                        /*    background-color: #7d7d7d;*/
                        border: 2px solid #7d7d7d;
                        padding: 2px;
                    }
                    </style>
                </head>
                <body>
                    <center>
                        <iframe src='" . $berkas->url_berkas . "' width='850' height='600'></iframe>
                    </center>
                </body>
            </html>
            ";
            exit();
        } else {
            abort(404);
            exit();
        }
    }

    public function verifikasi_qrcode($params)
    {
        if (!$params) {
            abort(404);
            exit();
        }

        $params = decode_arr($params);
        if (!$params) {
            abort(403);
            exit();
        }

        $get = SuratPerjalananDinas::with(['pegawai', 'departemen', 'reviwer', 'user'])->where('id', $params['sppd_id'])->first();
        // dd($get);
        $data = [
            'judul' => 'Data Pengajuan SPPD',
            'get' => $get
        ];
        return view('detail-sppd', $data);
    }
}
