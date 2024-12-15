<?php

namespace App\Livewire\Sppd;

use App\Models\Departemen;
use App\Models\KodeSurat;
use App\Models\RiwayatNomorSurat;
use App\Models\SuratPerjalananDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $judul = "Buat SPPD";

    public $id, $user_id, $nomor_spd, $pegawai_id, $departemen_id, $kegiatan_spd, $angkutan, $berangakat, $tujuan;
    public $lama_pd = 1, $tanggal_berangakat, $tanggal_kembali, $keterangan, $pejabat_ppk, $status_spd;

    public $mode = "add";

    public $show_daftar_surat = false;

    public $riwayat_nomor_surat = [];

    public function render()
    {
        return view('livewire.sppd.create');
    }

    public function show_modal_daftar_surat()
    {
        $this->show_daftar_surat = true;
        $this->dispatch('open-modal', modal: 'ModalDaftarSurat');
    }

    public function close_modal_daftar_surat()
    {
        $this->show_daftar_surat = false;
        $this->dispatch('close-modal', modal: 'ModalDaftarSurat');
    }

    #[On('generate-nomor-spd')]
    public function generate_nomor_spd($kodesurat_id)
    {
        // dd($kodesurat_id);
        $get = KodeSurat::where('id', $kodesurat_id)->first();

        $nomor = 1;
        $kode = "UN44" . "/" . $get->kode;
        $tahun = date('Y');
        $jenis_surat = 'spd';
        $keterangan = auth()->user()->name . ' membuat surat ' . $get->keterangan;

        $riwayat = RiwayatNomorSurat::kode($kode)->tahun($tahun)->jenis($jenis_surat)->orderBy('id', 'DESC')->limit(1)->first();
        if ($riwayat) {
            $nomor = (int) abs($riwayat->nomor) + 1;
        }

        $this->riwayat_nomor_surat = [
            'nomor' => $nomor,
            'kode' => $kode,
            'tahun' => $tahun,
            'jenis_surat' => $jenis_surat,
            'keterangan' => $keterangan
        ];

        $this->nomor_spd = $nomor . "/" . $kode . "/" . $tahun;
        $this->close_modal_daftar_surat();
    }

    public function save()
    {
        $this->validate([
            'nomor_spd' => 'required|unique:app_surat_perjalanan_dinas,nomor_spd',
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


        SuratPerjalananDinas::create([
            'user_id' => auth()->user()->id,
            'nomor_spd' => $this->nomor_spd,
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
            'status_spd' => '102', // 102 status spd baru di diajukan ke ppk
        ]);

        // simpan riwayat nomor surat
        RiwayatNomorSurat::create($this->riwayat_nomor_surat);
        $this->_clear_form();

        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'SPPD Berhasil Dibuat.');
    }

    public function _clear_form()
    {
        $this->resetErrorBag();

        // $this->id = "";
        // $this->nomor_spd = "";
        // $this->pegawai_id = "";
        // $this->departemen_id = "";
        // $this->kegiatan_spd = "";
        // $this->angkutan = "";
        // $this->berangakat = "";
        // $this->tujuan = "";
        // $this->lama_pd = "";
        // $this->tanggal_berangakat = "";
        // $this->tanggal_kembali = "";
        // $this->keterangan = "";
        // $this->status_spd = "";

        $this->show_daftar_surat = false;
        $this->riwayat_nomor_surat = [];
    }
}
