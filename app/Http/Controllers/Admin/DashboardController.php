<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use App\Models\Pegawai;
use App\Models\SuratPerjalananDinas;
use App\Models\SuratTugasDinas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $tahun = date('Y');
        $jml_pegawai = Pegawai::all()->count();
        $jml_departemen = Departemen::departemen(NULL)->get()->count();
        $jml_sppd = SuratPerjalananDinas::tahun($tahun)->status_spd(['200'])->get()->count();
        $jml_stugas = SuratTugasDinas::tahun($tahun)->status_std(['200'])->get()->count();

        $data = [
            'jml_pegawai' => $jml_pegawai,
            'jml_departemen' => $jml_departemen,
            'jml_sppd' => $jml_sppd,
            'jml_stugas' => $jml_stugas,
            'tahun' => $tahun
        ];

        if (auth()->user()->hasRole('ppk') && in_array(session('role'), ['ppk'])) {
            $datatable = [
                'tahun' => date('Y'),
                'datatable_departemen' => [
                    'url' => route('admin.dashboard.satistik-departemen'),
                    'id_table' => 'id-datatable1',
                    'columns' => [
                        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                        ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'true'],
                        ['data' => 'jml_sppd', 'name' => 'jml_sppd', 'orderable' => 'false', 'searchable' => 'false'],
                        ['data' => 'jml_std', 'name' => 'jml_std', 'orderable' => 'false', 'searchable' => 'false']
                    ]
                ],
                'datatable_pegawai' => [
                    'url' => route('admin.dashboard.satistik-pegawai'),
                    'id_table' => 'id-datatable2',
                    'columns' => [
                        ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                        ['data' => 'nama_pegawai', 'name' => 'nama_pegawai', 'orderable' => 'false', 'searchable' => 'true'],
                        ['data' => 'jabatan', 'name' => 'jabatan', 'orderable' => 'false', 'searchable' => 'false'],
                        ['data' => 'jml_sppd', 'name' => 'jml_sppd', 'orderable' => 'false', 'searchable' => 'false'],
                        ['data' => 'jml_std', 'name' => 'jml_std', 'orderable' => 'false', 'searchable' => 'false']
                    ]
                ]
            ];

            $data = array_merge($data, $datatable);
            return view('backend.admin.dashboard-ppk', $data);
        } else {
            return view('backend.admin.dashboard', $data);
        }
    }

    public function get_statistik_usulan_departemen(Request $request)
    {
        if ($request->ajax()) {
            $listdata = Departemen::with(['sppd', 'std'])->where('parent_id', NULL)->orderBy('created_at', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('jml_sppd', function ($row) {
                    return $row->sppd->count();
                })
                ->editColumn('jml_std', function ($row) {
                    return $row->std->count();
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('departemen', 'LIKE', "%$search%")->orWhere('lokasi', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['jml_sppd', 'jml_std'])
                ->make(true);
        }
    }

    public function get_statistik_usulan_pegawai(Request $request)
    {
        if ($request->ajax()) {
            $listdata = Pegawai::with(['sppd'])->orderBy('nama_pegawai', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('nama_pegawai', function ($row) {
                    $str = '
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-0">' . $row->nama_pegawai . '</li>
                        <li class="list-group-item p-0">NIP: ' . ($row->nip ?? '-') . '</li>
                    </ul>
                    ';
                    return $str;
                })
                ->editColumn('jml_sppd', function ($row) {
                    return $row->sppd->count();
                })
                ->editColumn('jml_std', function ($row) {
                    return '0';
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('nik', 'LIKE', "%$search%")
                                ->orWhere('nip', 'LIKE', "%$search%")
                                ->orWhere('nama_pegawai', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nama_pegawai', 'jml_sppd', 'jml_std'])
                ->make(true);
        }
    }
}
