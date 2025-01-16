<?php

namespace App\Livewire\Std;

use App\Models\Pimpinan;
use App\Models\SuratTugasDinas;
use Livewire\Component;

class Edit extends Component
{
    public $judul;

    public $nomor_surat, $kode_surat, $nomor_std;

    public $stugas_id, $departemen_id, $departemen, $kegiatan_std, $tanggal_mulai_tugas, $tanggal_selesai_tugas;
    public $keterangan, $pimpinan_ttd, $status_std;

    public $pegawai_id = [];

    public $tanggal_std;

    public $readonly = "readonly";

    public $fromSppd = false;

    public $pegawai_selected = [];

    public function mount($params, $judul)
    {
        $this->stugas_id = data_params($params, 'stugas_id');
        $this->judul = $judul;

        $get = SuratTugasDinas::with(['departemen', 'pegawai'])->where('id', $this->stugas_id)->first();
        $this->nomor_std = $get->nomor_std;

        $this->pecah_nomor_std($this->nomor_std);

        $this->tanggal_std = $get->tanggal_std;
        $this->departemen_id = $get->departemen_id;
        $this->departemen = $get->departemen->departemen;

        $this->kegiatan_std = $get->kegiatan_std;
        $this->tanggal_mulai_tugas = $get->tanggal_mulai_tugas;
        $this->tanggal_selesai_tugas = $get->tanggal_selesai_tugas;
        $this->keterangan = $get->keterangan;
        $this->status_std = $get->status_std;
        $this->pimpinan_ttd = get_datajson($get->pimpinan_ttd, 'id');

        foreach ($get->pegawai as $row) {
            $this->pegawai_id[] = $row->id;
            $this->pegawai_selected[] = [
                'id' => $row->id,
                'nama' => $row->nama_pegawai
            ];
        }

        if ($get->spd_id) {
            $this->fromSppd = true;
        }
    }

    public function pecah_nomor_std($nomor_std)
    {
        $pecah = explode("/", $nomor_std);
        $this->nomor_surat = trim($pecah[0]);
        $this->kode_surat = trim($pecah[1]) . "/" . trim($pecah[2]) . "/" . trim($pecah[3]);
    }

    public function render()
    {
        $pimpinan = Pimpinan::where('ppk', 0)->orderBy('nama_pimpinan', 'ASC')->get();
        if ($this->fromSppd) {
            return view('livewire.std.edit-from-sppd', ['pimpinan' => $pimpinan]);
        } else {
            return view('livewire.std.edit', ['pimpinan' => $pimpinan]);
        }
    }

    public function save()
    {
        $this->validate([
            'nomor_surat' => 'required|numeric|regex:/^[0-9]+$/',
            'kode_surat' => 'required',
            'nomor_std' => 'required|unique:app_surat_tugas_dinas,nomor_std,' . $this->stugas_id,
            'pegawai_id' => 'required|array|min:1',
            'departemen_id' => 'required',
            'kegiatan_std' => 'required',
            'tanggal_mulai_tugas' => 'required',
            'tanggal_selesai_tugas' => 'required',
            'pimpinan_ttd' => 'required',
            'tanggal_std' => 'required',
        ]);

        // dd($this);

        $pimpinan_ttd = Pimpinan::where('id', $this->pimpinan_ttd)->select(['id', 'nama_pimpinan', 'nip', 'jabatan', 'detail_jabatan'])->first()->toArray();

        $std = SuratTugasDinas::where('id', $this->stugas_id)->first();

        $this->status_std = '200';

        // remove daftar pegawai
        $std->pegawai()->sync([]);
        $std->update([
            'nomor_std' => $this->nomor_std,
            'tanggal_std' => $this->tanggal_std,
            'departemen_id' => $this->departemen_id,
            'kegiatan_std' => $this->kegiatan_std,
            'tanggal_mulai_tugas' => $this->tanggal_mulai_tugas,
            'tanggal_selesai_tugas' => $this->tanggal_selesai_tugas,
            'pimpinan_ttd' => json_encode($pimpinan_ttd),
            'keterangan' => $this->keterangan,
            'status_std' => $this->status_std,
        ]);

        // simpan daftar pegawai
        $std->pegawai()->sync($this->pegawai_id);

        $this->_clear_form();
        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'Surat Tugas Berhasil Diedit.');
    }

    public function _clear_form()
    {
        $this->resetErrorBag();
    }
}
