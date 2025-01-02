<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listdata = Pegawai::with('departemen')->orderBy('nama_pegawai', 'ASC');
            return DataTables::eloquent($listdata)
                ->addIndexColumn()
                ->editColumn('action', function ($row) {
                    $onclickEdit = "edit('" . $row->id . "')";
                    $onclickDetail = "detail('" . $row->id . "')";
                    $actionBtn = '
                    <center>
                        <button type="button" onclick="' . $onclickEdit . '" class="btn btn-sm btn-warning">Edit</button>
                        <button type="button" onclick="' . $onclickDetail . '" class="btn btn-sm btn-info">Detail</button>
                    </center>';
                    return $actionBtn;
                })
                ->editColumn('nama_pegawai', function ($row) {
                    $str = '
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-0">' . $row->nama_pegawai . '</li>
                        <li class="list-group-item p-0">NIP: ' . ($row->nip ?? '-') . '</li>
                    </ul>
                    ';
                    return $str;
                })
                ->editColumn('departemen', function ($row) {
                    $str = $row->departemen?->departemen;
                    return $str;
                })
                ->editColumn('ttl', function ($row) {
                    $str = $row->tempat_lahir . ', ' . $row->tanggal_lahir;
                    return $str;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('kategori')) {
                        $kategori = data_params($request->get('kategori'), 'kategori');
                        $instance->where('kategori_pegawai', $kategori);
                    }

                    if (!empty($request->input('search.value'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->input('search.value');
                            $w->orWhere('nik', 'LIKE', "%$search%")
                                ->orWhere('nip', 'LIKE', "%$search%")
                                ->orWhere('nama_pegawai', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['nama_pegawai', 'ttl', 'departemen', 'action'])
                ->make(true);
        }

        $data = [
            'judul' => 'Data Pegawai',
            'kategori' => kategori_pegawai(),
            'datatable2' => [
                'url' => route('admin.pegawai.index'),
                'id_table' => 'id-datatable',
                'columns' => [
                    ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'nama_pegawai', 'name' => 'nama_pegawai', 'orderable' => 'false', 'searchable' => 'true'],
                    ['data' => 'jk', 'name' => 'jk', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'ttl', 'name' => 'ttl', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'jabatan', 'name' => 'jabatan', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'departemen', 'name' => 'departemen', 'orderable' => 'false', 'searchable' => 'false'],
                    ['data' => 'action', 'name' => 'action', 'orderable' => 'false', 'searchable' => 'false']
                ]
            ]
        ];

        return view('backend.admin.pegawai', $data);
    }

    public function importdata($params)
    {
        $kategori = data_params($params, 'kategori');
        $data = [
            'judul' => 'Import Data Pegawai',
            'kategori_str' => kategori_pegawai($kategori),
            'kategori' => $kategori,
        ];

        return view('backend.admin.pegawai-import', $data);
    }

    public function act_importdata(Request $request)
    {
        $data = json_decode(request('data'));
        $errors = [];

        $validator = Validator::make($request->all('data'), ['data' => ['required']], [
            'data.required' => 'Data Pegawai wajib di isi minimal 1 data.'
        ]);
        if ($validator->fails()) {
            $errors['data'] = $validator->errors();
        }

        if ($errors) {
            return redirect()->back()->with('galat', $errors)->withInput();
        }

        $formattedData = [];
        foreach ($data as $index => $row) {
            if (trim($row->nik) && trim($row->nama_pegawai)) {
                $formattedData[] = [
                    'baris' => ($index + 1),
                    'nik' => $row->nik ? trim($row->nik) : NULL,
                    'nama_pegawai' => $row->nama_pegawai ? trim($row->nama_pegawai) : NULL,
                    'jk' => $row->jk ? trim($row->jk) : NULL,
                    'kategori_pegawai' => $request->kategori ? trim($row->kategori) : NULL,
                    'nip' => $row->nip ? trim($row->nip) : NULL,
                    'tempat_lahir' => $row->tempat_lahir ? trim($row->tempat_lahir) : NULL,
                    'tanggal_lahir' => $row->tanggal_lahir ? trim($row->tanggal_lahir) : NULL,
                    'hp' => $row->hp ? trim($row->hp) : NULL,
                    'jabatan' => $row->jabatan ? trim($row->jabatan) : NULL
                ];
            }
        }


        $validator = Validator::make($request->all('kategori'), ['kategori' => ['required']], [
            'kategori.required' => 'Kategori Pegawai jangan dikosongkan!'
        ]);
        if ($validator->fails()) {
            $errors['kategori'] = $validator->errors();
        }

        foreach ($formattedData as $data) {
            $validator = Validator::make($data, [
                'nik' => ['required', 'numeric', 'unique:app_pegawai,nik'],
                'nama_pegawai' => ['required']
            ], [
                'nik.required' => 'NIK jangan dikosongkan!',
                'nik.numeric' => 'NIK harus berbentuk angka!',
                'nik.unique' => 'NIK sudah terdaftar!',

                'nama_pegawai.required' => 'Nama Pegawai jangan dikosongkan!',
            ]);

            if ($validator->fails()) {
                $errors['peserta'][] = [
                    'baris' => $data['baris'],
                    'errors' => $validator->errors()
                ];
            }
        }

        if ($errors) {
            return redirect()->back()->with('galat', $errors)->withInput();
        }

        foreach ($formattedData as $row) {
            $peserta = Pegawai::create([
                'kategori_pegawai' => request()->input('kategori'),
                'nik' => trim($row['nik']),
                'nama_pegawai' => $row['nama_pegawai'],
                'jk' => $row['jk'],
                'nip' => $row['nip'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'hp' => $row['hp'],
                'jabatan' => $row['jabatan']
            ]);
        }

        alert()->success('Success', 'Berhasil import ' . count($formattedData) . ' data pegawai');
        return redirect(route('admin.pegawai.index'))->withInput(['kategori' => encode_arr(['kategori' => request()->input('kategori')])]);
    }

    public function search_pegawai(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->get('type')) && $request->get('type') == 'search-pegawai') {
                $search_term = $request->get('search');

                $pegawai = Pegawai::pencarian($search_term)->orderBy('nama_pegawai', 'ASC')->limit(10)->get();

                // Generate array with filtered records  
                $usersData = [];
                foreach ($pegawai as $row) {
                    $data['id'] = $row->id;
                    $data['text'] = $row->nama_pegawai;
                    array_push($usersData, $data);
                }

                return Response::json($usersData, 200);
            }
        }
    }
}
