<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PimpinanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listdata = Pimpinan::with('mendelegasikan')->orderBy('created_at', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $onclick = "edit('" . $row->id . "')";
                    $actionBtn = '
                    <center>
                        <button type="button" onclick="' . $onclick . '" class="btn btn-sm btn-warning">Edit</button>
                    </center>';
                    return $actionBtn;
                })
                ->editColumn('nama_pimpinan', function ($row) {
                    $sup = '';
                    return $row->nama_pimpinan . $sup;
                })
                ->editColumn('jabatan', function ($row) {
                    $str = $row->detail_jabatan;
                    $str .= '<br>Singkat: &nbsp;' . $row->jabatan;
                    return $str;
                })
                ->editColumn('user_delegasi', function ($row) {
                    $str = "-";
                    if (!$row->ppk) {
                        $str = $row->mendelegasikan->name ?? '';
                    }
                    return $str;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('nama_pimpinan', 'LIKE', "%$search%")->orWhere('nip', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nama_pimpinan', 'jabatan', 'user_delegasi', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Data Pimpinan',
            'datatable' => [
                'url' => route('admin.pimpinan.index'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'nip', 'name' => 'nip', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'nama_pimpinan', 'name' => 'nama_pimpinan', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'jabatan', 'name' => 'jabatan', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'user_delegasi', 'name' => 'user_delegasi', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.pimpinan', $data);
    }
}
