<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeSurat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KodeSuratController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listdata = KodeSurat::orderBy('urutan', 'ASC');
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
                ->editColumn('kode', function ($row) {
                    $spasi = $row->parent_id ? str_repeat('-', 4) . ' ' : '';
                    return $spasi . $row->kode;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('kode', 'LIKE', "%$search%")->orWhere('keterangan', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['kode', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Data Kode Surat',
            'datatable' => [
                'url' => route('admin.kodesurat.index'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'kode', 'name' => 'kode', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'keterangan', 'name' => 'keterangan', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.kode-surat', $data);
    }
}
