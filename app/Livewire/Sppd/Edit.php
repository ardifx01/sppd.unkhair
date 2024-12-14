<?php

namespace App\Livewire\Sppd;

use App\Models\SuratPerjalananDinas;
use Livewire\Component;

class Edit extends Component
{
    public $judul = "Edit SPPD";

    public $sppd_id;

    public $nomor_spd, $pegawai_id, $departemen_id, $kegiatan_spd, $angkutan, $berangakat, $tujuan;
    public $lama_pd = 1, $tanggal_berangakat, $tanggal_kembali, $keterangan, $pejabat_ppk, $status_spd;

    public $nama_pegawai;
    public $departemen;


    public function mount($params)
    {
        $this->sppd_id = data_params($params, 'sppd_id');
        $get = SuratPerjalananDinas::with(['pegawai', 'departemen'])->where('id', $this->sppd_id)->first();
        $this->nomor_spd = $get->nomor_spd;
        $this->pegawai_id = $get->pegawai_id;
        $this->departemen_id = $get->departemen_id;
        $this->kegiatan_spd = $get->kegiatan_spd;
        $this->angkutan = $get->angkutan;
        $this->berangakat = $get->berangakat;
        $this->tujuan = $get->tujuan;
        $this->lama_pd = $get->lama_pd;
        $this->tanggal_berangakat = $get->tanggal_berangakat;
        $this->tanggal_kembali = $get->tanggal_kembali;
        $this->keterangan = $get->keterangan;

        $this->nama_pegawai = $get->pegawai->nama_pegawai;
        $this->departemen = $get->departemen->departemen;
    }

    public function render()
    {
        return view('livewire.sppd.edit');
    }

    public function save()
    {
        $this->validate([
            'nomor_spd' => 'required|unique:app_surat_perjalanan_dinas,nomor_spd,' . $this->sppd_id,
            'pegawai_id' => 'required',
            'departemen_id' => 'required',
            'kegiatan_spd' => 'required',
            'angkutan' => 'required',
            'berangakat' => 'required',
            'tujuan' => 'required',
            'lama_pd' => 'required|min_digits:1',
            'tanggal_berangakat' => 'required',
            'tanggal_kembali' => 'required'
        ]);


        SuratPerjalananDinas::where('id', $this->sppd_id)->update([
            'pegawai_id' => $this->pegawai_id,
            'departemen_id' => $this->departemen_id,
            'kegiatan_spd' => $this->kegiatan_spd,
            'angkutan' => $this->angkutan,
            'berangakat' => $this->berangakat,
            'tujuan' => $this->tujuan,
            'lama_pd' => $this->lama_pd,
            'tanggal_berangakat' => $this->tanggal_berangakat,
            'tanggal_kembali' => $this->tanggal_kembali,
            'keterangan' => $this->keterangan,
        ]);

        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'SPPD Berhasil Diedit.');
    }
}
