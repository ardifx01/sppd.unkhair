<?php

namespace App\Livewire\Sppd;

use App\Models\SuratPerjalananDinas;
use Livewire\Component;

class Edit extends Component
{
    public $judul = "Edit SPPD";

    public $sppd_id;

    public $nomor_surat, $kode_surat, $nomor_spd;
    public $pegawai_id, $departemen_id, $kegiatan_spd, $angkutan, $berangakat, $tujuan;
    public $lama_pd = 1, $tanggal_berangakat, $tanggal_kembali, $keterangan, $pejabat_ppk, $status_spd;
    public $kode_mak, $detail_alokasi_anggaran;

    public $tanggal_spd;

    public $readonly = "readonly";

    public $nama_pegawai;
    public $departemen;


    public function mount($params)
    {
        $this->sppd_id = data_params($params, 'sppd_id');
        $get = SuratPerjalananDinas::with(['pegawai', 'departemen'])->where('id', $this->sppd_id)->first();
        $this->nomor_spd = $get->nomor_spd;

        $this->pecah_nomor_spd($this->nomor_spd);

        $this->tanggal_spd = $get->tanggal_spd;
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
        $this->kode_mak = $get->kode_mak;
        $this->detail_alokasi_anggaran = $get->detail_alokasi_anggaran;

        $this->nama_pegawai = $get->pegawai->nama_pegawai;
        $this->departemen = $get->departemen->departemen;
    }

    public function pecah_nomor_spd($nomor_spd)
    {
        $pecah = explode("/", $nomor_spd);
        $this->nomor_surat = trim($pecah[0]);
        $this->kode_surat = trim($pecah[1]) . "/" . trim($pecah[2]) . "/" . trim($pecah[3]);
    }

    public function render()
    {
        return view('livewire.sppd.edit');
    }

    public function pass_tanggal_kembali($value, $form = NULL)
    {
        if ($form == 'lama_pd') {
            $this->lama_pd = $value;
            if ($this->tanggal_berangakat) {
                $this->tanggal_kembali = add_tanggal($this->tanggal_berangakat, $this->lama_pd);
            }
        }

        if ($form == 'tanggal_berangakat') {
            $this->tanggal_berangakat = $value;
            if ($this->tanggal_berangakat) {
                $this->tanggal_kembali = add_tanggal($this->tanggal_berangakat, $this->lama_pd);
            }
        }
    }

    public function save()
    {
        $this->validate([
            'nomor_surat' => 'required|numeric|integer',
            'kode_surat' => 'required',
            'nomor_spd' => 'required|unique:app_surat_perjalanan_dinas,nomor_spd,' . $this->sppd_id,
            'pegawai_id' => 'required',
            'departemen_id' => 'required',
            'kegiatan_spd' => 'required',
            'angkutan' => 'required',
            'berangakat' => 'required',
            'tujuan' => 'required',
            'lama_pd' => 'required|min_digits:1',
            'tanggal_berangakat' => 'required',
            'tanggal_kembali' => 'required',
            'kode_mak' => 'required',
            'tanggal_spd' => 'required',
        ]);


        SuratPerjalananDinas::where('id', $this->sppd_id)->update([
            'tanggal_spd' => $this->tanggal_spd,
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
            'kode_mak' => $this->kode_mak,
            'detail_alokasi_anggaran' => $this->detail_alokasi_anggaran,
        ]);

        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'SPPD Berhasil Diedit.');
    }
}
