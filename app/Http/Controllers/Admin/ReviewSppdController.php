<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratPerjalananDinas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Str;

class ReviewSppdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:ppk']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listdata = SuratPerjalananDinas::with(['departemen'])->status_spd(['102'])->join('app_pegawai AS b', 'app_surat_perjalanan_dinas.pegawai_id', '=', 'b.id')
                ->select([
                    'app_surat_perjalanan_dinas.id',
                    'app_surat_perjalanan_dinas.nomor_spd',
                    'app_surat_perjalanan_dinas.kegiatan_spd',
                    'app_surat_perjalanan_dinas.tujuan',
                    'app_surat_perjalanan_dinas.created_at',
                    'app_surat_perjalanan_dinas.departemen_id',
                    'b.nama_pegawai'
                ])
                ->orderBy('app_surat_perjalanan_dinas.created_at', 'ASC')
                ->orderBy('app_surat_perjalanan_dinas.nomor_spd', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $onclick = "review('" . encode_arr(['sppd_id' => $row->id]) . "')";
                    $actionBtn = '
                    <center>
                        <button type="button" onclick="' . $onclick . '" class="btn btn-sm btn-info"><i class="fa fa-search"></i> Review</button>
                    </center>';
                    return $actionBtn;
                })
                ->editColumn('nomor_spd', function ($row) {
                    $str = Str::words($row->kegiatan_spd, 10, '...');
                    $str .= '<br><b>Nomor: </b><span class="text-primary">' . $row->nomor_spd . '</span>';
                    return  $str;
                })
                ->editColumn('pegawai', function ($row) {
                    $str = $row->nama_pegawai;
                    return  $str;
                })
                ->editColumn('departemen', function ($row) {
                    return $row->departemen->departemen ?? '-';
                })
                ->editColumn('tgl_pengajuan', function ($row) {
                    return tgl_indo($row->created_at);
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('app_surat_perjalanan_dinas.nomor_spd', 'LIKE', "%$search%")
                                ->orWhere('b.nama_pegawai', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nomor_spd', 'pegawai', 'departemen', 'status', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Daftar Pengajuan SPPD',
            'datatable' => [
                'url' => route('admin.sppd.review'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'nomor_spd', 'name' => 'nomor_spd', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'pegawai', 'name' => 'pegawai', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'tujuan', 'name' => 'tujuan', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'tgl_pengajuan', 'name' => 'tgl_pengajuan', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.sppd.review', $data);
    }
}
