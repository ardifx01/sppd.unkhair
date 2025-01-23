<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratTugasDinas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Str;

class StdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin-st']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tahun = date('Y');
            $listdata = SuratTugasDinas::with(['departemen', 'pegawai'])->tahun(date('Y'))->status_std(['200'])->tahun($tahun)
                ->select([
                    'app_surat_tugas_dinas.id',
                    'app_surat_tugas_dinas.nomor_std',
                    'app_surat_tugas_dinas.kegiatan_std',
                    'app_surat_tugas_dinas.tanggal_mulai_tugas',
                    'app_surat_tugas_dinas.tanggal_selesai_tugas',
                    'app_surat_tugas_dinas.departemen_id'
                ])
                ->orderBy('app_surat_tugas_dinas.created_at', 'DESC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $edit = "edit('" . encode_arr(['stugas_id' => $row->id]) . "')";
                    $detail = "detail('" . encode_arr(['stugas_id' => $row->id]) . "')";
                    $confirm = "return confirm('Apakah Anda Yakin Menghapus Data?');";
                    $actionBtn = '
                    <center>
                        <a href="' . route('cetak.std', encode_arr(['stugas_id' => $row->id])) . '" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>    
                        <button type="button" onclick="' . $detail . '" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>
                        <button type="button" onclick="' . $edit . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                        <!--
                        <a href="' . route('admin.std.delete', encode_arr(['std_id' => $row->id])) . '" onclick="' . $confirm . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        -->
                    </center>';
                    return $actionBtn;
                })
                ->editColumn('nomor_std', function ($row) {
                    $detail = "detail('" . encode_arr(['stugas_id' => $row->id]) . "')";
                    $str = '<ul class="list-group list-group-flush">';
                    $str .= '<li class="list-group-item p-0">' . (Str::limit($row->kegiatan_std, 60, ' ...')) . '</li>';
                    $str .= '<li class="list-group-item p-0"><a href="#" onclick="' . $detail . '" class="">' . $row->nomor_std . '</a></li>';
                    $str .= '</ul>';
                    return $str;
                })
                ->editColumn('tanggal_dinas', function ($row) {
                    $str = str_tanggal_dinas($row->tanggal_mulai_tugas, $row->tanggal_selesai_tugas);
                    return $str;
                })
                ->editColumn('pegawai', function ($row) {
                    $str = '<ul class="list-group list-group-flush">';
                    foreach ($row->pegawai as $index => $r) {
                        $nomor = $index + 1;
                        if ($nomor <= 3) {
                            $str .= '<li class="list-group-item p-0">' . $nomor . '. ' . $r->nama_pegawai . '</li>';
                        } else {
                            $str .= '<li class="list-group-item p-0 text-muted">&nbsp;... </li>';
                            break;
                        }
                    }
                    $str .= '</ul>';
                    return  $str;
                })
                ->editColumn('departemen', function ($row) {
                    return $row->departemen->departemen ?? '-';
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('app_surat_tugas_dinas.nomor_std', 'LIKE', "%$search%")
                                ->orWhere('app_surat_tugas_dinas.kegiatan_std', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nomor_std', 'pegawai', 'tanggal_dinas', 'departemen', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Data STD',
            'datatable' => [
                'url' => route('admin.std.index'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'nomor_std', 'name' => 'nomor_std', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'tanggal_dinas', 'name' => 'tanggal_dinas', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'pegawai', 'name' => 'pegawai', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.std.index', $data);
    }

    public function create()
    {
        $data = [
            'judul' => 'Buat STD',
        ];

        return view('backend.admin.std.create', $data);
    }

    public function stdfromsppd(Request $request)
    {
        if ($request->ajax()) {
            $tahun = date('Y');
            $listdata = SuratTugasDinas::with(['pegawai'])->status_std(['206'])->tahun($tahun)
                ->select([
                    'app_surat_tugas_dinas.id',
                    'app_surat_tugas_dinas.nomor_std',
                    'app_surat_tugas_dinas.kegiatan_std',
                    'app_surat_tugas_dinas.tanggal_mulai_tugas',
                    'app_surat_tugas_dinas.tanggal_selesai_tugas',
                    'app_surat_tugas_dinas.created_at',
                ])
                ->orderBy('app_surat_tugas_dinas.created_at', 'ASC')
                ->orderBy('app_surat_tugas_dinas.nomor_std', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $edit = "edit('" . encode_arr(['stugas_id' => $row->id]) . "')";
                    $actionBtn = '
                    <center>
                        <button type="button" onclick="' . $edit . '" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Lengkapi</button>
                    </center>';
                    return $actionBtn;
                })
                ->editColumn('nomor_std', function ($row) {
                    $str = '<ul class="list-group list-group-flush">';
                    $str .= '<li class="list-group-item p-0">' . (Str::limit($row->kegiatan_std, 60, ' ...')) . '</li>';
                    $str .= '<li class="list-group-item p-0">Nomor: ' . $row->nomor_std . '</li>';
                    $str .= '</ul>';
                    return $str;
                })
                ->editColumn('tanggal_dinas', function ($row) {
                    $str = str_tanggal_dinas($row->tanggal_mulai_tugas, $row->tanggal_selesai_tugas);
                    return $str;
                })
                ->editColumn('pegawai', function ($row) {
                    $str = '<ul class="list-group list-group-flush">';
                    foreach ($row->pegawai as $index => $r) {
                        $nomor = $index + 1;
                        if ($nomor <= 3) {
                            $str .= '<li class="list-group-item p-0">' . $nomor . '. ' . $r->nama_pegawai . '</li>';
                        } else {
                            $str .= '<li class="list-group-item p-0 text-muted">&nbsp;... </li>';
                            break;
                        }
                    }
                    $str .= '</ul>';
                    return  $str;
                })
                ->editColumn('dibuat', function ($row) {
                    $str = tgl_indo($row->created_at);
                    return $str;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('app_surat_tugas_dinas.nomor_std', 'LIKE', "%$search%")
                                ->orWhere('app_surat_tugas_dinas.kegiatan_std', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nomor_std', 'tanggal_dinas', 'pegawai', 'dibuat', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Daftar STD Dari SPPD',
            'datatable' => [
                'url' => route('admin.std.fromSppd'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'nomor_std', 'name' => 'nomor_std', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'tanggal_dinas', 'name' => 'tanggal_dinas', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'pegawai', 'name' => 'pegawai', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'dibuat', 'name' => 'dibuat', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.std.from-sppd', $data);
    }

    public function edit($params)
    {
        $data = [
            'judul' => 'Edit STD',
            'params' => $params
        ];

        return view('backend.admin.std.edit', $data);
    }

    public function delete($params)
    {
        $std_id = data_params($params, 'std_id');
        SuratTugasDinas::where('id', $std_id)->update(['status_std' => '204']);
        alert()->success('Success', 'Data STD Berhasil Dihapus');
        return redirect(route('admin.std.index'));
    }
}
