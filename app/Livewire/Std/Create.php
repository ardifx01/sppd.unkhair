<?php

namespace App\Livewire\Std;

use App\Models\KodeSurat;
use App\Models\Pimpinan;
use App\Models\RiwayatNomorSurat;
use App\Models\SuratPerjalananDinas;
use App\Models\SuratTugasDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $judul = "Buat Surat Tugas";

    public $id, $spd_id, $user_id, $nomor_std, $pegawai_id = [], $departemen_id, $departemen, $kegiatan_std, $tanggal_mulai_tugas, $tanggal_selesai_tugas;
    public $keterangan, $pimpinan_ttd, $status_std = '200';

    public $nama_pegawai;

    public $show_daftar_surat = false;

    public $riwayat_nomor_surat = [];


    public function mount($params = NULL)
    {
        if ($params) {
            $this->spd_id = data_params($params, 'spd_id');

            $get = SuratPerjalananDinas::with(['departemen', 'pegawai'])->where('id', $this->spd_id)
                ->select(['id', 'departemen_id', 'pegawai_id', 'kegiatan_spd', 'tanggal_berangakat', 'tanggal_kembali'])->first();
            $this->departemen_id = $get->departemen_id;
            $this->departemen = $get->departemen->departemen;
            $this->kegiatan_std = $get->kegiatan_spd;
            $this->tanggal_mulai_tugas = $get->tanggal_berangakat;
            $this->tanggal_selesai_tugas = $get->tanggal_kembali;
            $this->pegawai_id[] = $get->pegawai_id;
            $this->nama_pegawai = $get->pegawai->nama_pegawai;
        }
    }

    public function render()
    {
        $pimpinan = Pimpinan::where('ppk', 0)->orderBy('nama_pimpinan', 'ASC')->get();
        $view = 'livewire.std.create';
        if ($this->spd_id) {
            $view = 'livewire.std.create-from-sppd';
        }
        return view($view, ['pimpinan' => $pimpinan]);
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

    #[On('generate-nomor-std')]
    public function generate_nomor_std($kodesurat_id)
    {
        // dd($kodesurat_id);
        $get = KodeSurat::where('id', $kodesurat_id)->first();

        $nomor = 1;
        $kode = "UN44" . "/" . $get->kode;
        $tahun = date('Y');
        $jenis_surat = 'st';
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

        $this->nomor_std = $nomor . "/" . $kode . "/" . $tahun;
        $this->close_modal_daftar_surat();
    }

    public function save()
    {
        // dd($this->pegawai_id);
        $this->validate([
            'nomor_std' => 'required|unique:app_surat_tugas_dinas,nomor_std',
            'pegawai_id' => 'required|array|min:1',
            'departemen_id' => 'required',
            'kegiatan_std' => 'required',
            'tanggal_mulai_tugas' => 'required',
            'tanggal_selesai_tugas' => 'required',
            'pimpinan_ttd' => 'required'
        ]);

        // dd($this);

        $pimpinan_ttd = Pimpinan::where('id', $this->pimpinan_ttd)->select(['id', 'nama_pimpinan', 'nip', 'jabatan', 'detail_jabatan'])->first()->toArray();
        $std = SuratTugasDinas::create([
            'user_id' => auth()->user()->id,
            'spd_id' => $this->spd_id,
            'nomor_std' => $this->nomor_std,
            'departemen_id' => $this->departemen_id,
            'kegiatan_std' => $this->kegiatan_std,
            'tanggal_mulai_tugas' => $this->tanggal_mulai_tugas,
            'tanggal_selesai_tugas' => $this->tanggal_selesai_tugas,
            'pimpinan_ttd' => json_encode($pimpinan_ttd),
            'keterangan' => $this->keterangan,
            'status_std' => $this->status_std,
        ]);

        $this->id = $std->id->toString();

        // simpan daftar pegawai
        $std->pegawai()->sync($this->pegawai_id);

        // simpan riwayat nomor surat
        RiwayatNomorSurat::create($this->riwayat_nomor_surat);
        $this->_clear_form();

        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'Surat Tugas Berhasil Dibuat.');
    }

    public function _clear_form()
    {
        $this->resetErrorBag();

        $this->show_daftar_surat = false;
        $this->riwayat_nomor_surat = [];
    }
}
