<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;

if (!function_exists('roles')) {
    function roles()
    {
        $expire = Carbon::now()->addMinutes(300); // 5 menit
        $select = Cache::remember('roles', $expire, function () {
            return Role::select(['id', 'name'])->orderBy('created_at', 'ASC')->get();
        });
        return $select;
    }
}

if (!function_exists('my_roles')) {
    function my_roles()
    {
        return auth()->user()->roles()->get();
    }
}

if (!function_exists('strip_tags_content')) {
    function strip_tags_content($string)
    {
        return strip_tags(html_entity_decode($string));
    }
}

if (!function_exists('tampil_aset')) {
    function tampil_aset($aset)
    {
        if (!trim($aset)) {
            return '';
        }

        $array = json_decode($aset);
        $str = '';
        if ($array) {
            foreach ($array as $r) {
                $baca = get_referensi($r);
                $str .= $baca . ", ";
            }
        }
        return $str ? rtrim($str, ", ") : '';
    }
}

if (!function_exists('kategori_pegawai')) {
    function kategori_pegawai($key = NULL)
    {
        $kategori = [
            'dosen-pns' => 'Dosen PNS',
            'dosen-kontrak' => 'Dosen Kontrak',
            'tendik-pns' => 'Tendik PNS',
            'tendik-kontrak' => 'Tendik Kontrak',
        ];

        if ($key && array_key_exists($key, $kategori)) {
            return $kategori[$key];
        }

        return $kategori;
    }
}

if (!function_exists('agama')) {
    function agama($key = NULL)
    {
        $agama = [
            'islam' => 'Islam',
            'kristen-protestan' => 'Kristen Protestan',
            'kristen-katolik' => 'Kristen Katolik',
            'hindu' => 'Hindu',
            'buddha' => 'Buddha',
            'konghucu' => 'Konghucu',
        ];

        if ($key && array_key_exists($key, $agama)) {
            return $agama[$key];
        }

        return $agama;
    }
}

if (!function_exists('str_status_sppd')) {
    function str_status_sppd($key = NULL)
    {
        $status = [
            '102' => '<span class="text-muted">Sedang Pengajuan</span>',
            '406' => '<span class="text-danger">Pengajuan Ditolak!</span>',
            '200' => '<span class="text-success">Pengajuan Disetujui</span>',
        ];

        if ($status && array_key_exists($key, $status)) {
            return $status[$key];
        }

        return '';
    }
}

if (!function_exists('get_datajson')) {
    function get_datajson($json, $key = NULL)
    {
        $json = json_decode($json, true);
        if ($json && array_key_exists($key, $json)) {
            return $json[$key];
        }
        return $json;
    }
}

if (!function_exists('str_role')) {
    function str_role($key = NULL)
    {
        $roles = [
            'developper' => 'Developper',
            'super-admin' => 'Super Admin',
            'admin-spd' => 'Admin SPD',
            'admin-st' => 'Admin STD',
            'ppk' => 'PPK',
        ];

        if ($roles && array_key_exists($key, $roles)) {
            return $roles[$key];
        }

        return '';
    }
}

if (!function_exists('get_image')) {
    function get_image($path_image = NULL)
    {
        $type = pathinfo($path_image, PATHINFO_EXTENSION);
        $data = file_get_contents($path_image);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
