<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listdata = Departemen::with('subDepartemen')->where('parent_id', NULL)->orderBy('created_at', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $onclick = "edit('" . $row->id . "')";
                    $jml_unitkhusus = $row->subDepartemen->count();
                    $actionBtn = '
                    <center>
                        <a href="' . route('admin.departemen.unitkhusus', encode_arr(['parent_id' => $row->id])) . '" class="btn btn-sm btn-info">Unit (' . $jml_unitkhusus . ')</a>
                        <button type="button" onclick="' . $onclick . '" class="btn btn-sm btn-warning">Edit</button>
                    </center>';
                    return $actionBtn;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('departemen', 'LIKE', "%$search%")->orWhere('lokasi', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Data Departemen',
            'datatable' => [
                'url' => route('admin.departemen.index'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'lokasi', 'name' => 'lokasi', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.departemen', $data);
    }

    public function unitkhusus(Request $request, $params)
    {
        $departemen = Departemen::with('subDepartemen')->where('id', data_params($params, 'parent_id'))->first();
        $unitpusat = $departemen->departemen;
        if ($request->ajax()) {
            $listdata = $departemen->subDepartemen()->orderBy('created_at', 'ASC');
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
                ->editColumn('unit_pusat', function ($row) use ($unitpusat) {
                    return $unitpusat;
                })
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('departemen', 'LIKE', "%$search%")->orWhere('lokasi', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['unit_pusat', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Unit Departemen',
            'unitpusat' => $unitpusat,
            'params' => $params,
            'datatable' => [
                'url' => route('admin.departemen.unitkhusus', $params),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'unit_pusat', 'name' => 'unit_pusat', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'lokasi', 'name' => 'lokasi', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.departemen-unitkhusus', $data);
    }

    public function search_departemen(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->get('type')) && $request->get('type') == 'search-departemen') {
                $search_term = $request->get('search');

                $departemen = Departemen::departemen(NULL)->pencarian($search_term)->orderBy('departemen', 'ASC')->limit(10)->get();

                // Generate array with filtered records  
                $usersData = [];
                foreach ($departemen as $row) {
                    $data['id'] = $row->id;
                    $data['text'] = $row->departemen;
                    array_push($usersData, $data);
                }

                return Response::json($usersData, 200);
            }
        }
    }
}
