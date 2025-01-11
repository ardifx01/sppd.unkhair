<?php

namespace App\Livewire\Sppd;

use App\Models\Pimpinan;
use App\Models\RiwayatNomorSurat;
use App\Models\SuratPerjalananDinas;
use App\Models\SuratTugasDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class ReviewSppd extends Component
{
    public $modal = "ModalReviewSPPD";
    public $judul = "Review Pengajuan SPPD";
    public $params;
    public $get;
    public $listppk;

    public $status_spd, $alasan, $pejabat_ppk;

    public function render()
    {
        return view('livewire.sppd.review-sppd');
    }

    #[On('review-pengajuan-sppd')]
    public function review($params)
    {
        $this->params = decode_arr($params);
        $this->get = SuratPerjalananDinas::with(['pegawai', 'departemen', 'user'])->where('id', $this->params['sppd_id'])->first();
        $this->listppk = Pimpinan::where('ppk', 1)->orderBy('nama_pimpinan', 'ASC')->get();
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $rules = [
            'status_spd' => 'required',
            'pejabat_ppk' => 'required'
        ];

        if ($this->status_spd && $this->status_spd != '200') {
            $rules += ['alasan' => 'required'];
            unset($rules['pejabat_ppk']);
        }
        $this->validate($rules);

        $pejabat_ppk = Pimpinan::where('id', $this->pejabat_ppk)->select(['id', 'nama_pimpinan', 'nip', 'jabatan', 'detail_jabatan'])->first()->toArray();
        SuratPerjalananDinas::where('id', $this->params['sppd_id'])->update([
            'status_spd' => $this->status_spd,
            'pejabat_ppk' => json_encode($pejabat_ppk),
            'tanggal_review' => now(),
            'reviewer_id' => auth()->user()->id,
            'alasan' => $this->alasan,
        ]);

        // auto create STD
        if ($this->status_spd == '200') {
            $this->create_std();
        }


        $this->dispatch('alert', type: 'success', title: 'Succesfully', message: 'Berhasil Review Pengajuan SPPD');
        $this->_reset();
        $this->dispatch('load-datatable');
    }

    public function create_std()
    {
        $pegawai_id = [];

        $nomor_spd = $this->get->nomor_spd;

        $nomor_std = $this->generate_nomor_std($nomor_spd);
        $departemen_id = $this->get->departemen_id;
        $kegiatan_std = $this->get->kegiatan_spd;
        $tanggal_mulai_tugas = $this->get->tanggal_berangakat;
        $tanggal_selesai_tugas = $this->get->tanggal_kembali;
        $pegawai_id[] = $this->get->pegawai_id;

        $values = [
            'user_id' => auth()->user()->id,
            'spd_id' => $this->params['sppd_id'],
            'nomor_std' => $nomor_std,
            'departemen_id' => $departemen_id,
            'kegiatan_std' => $kegiatan_std,
            'tanggal_mulai_tugas' => $tanggal_mulai_tugas,
            'tanggal_selesai_tugas' => $tanggal_selesai_tugas,
            'status_std' => '206', // kode STD belum lengkap
        ];
        // dd($values, $pegawai_id);

        $std = SuratTugasDinas::create($values);
        // simpan daftar pegawai
        $std->pegawai()->sync($pegawai_id);

        return TRUE;
    }

    public function generate_nomor_std($nomor_spd)
    {
        // pecah nomor_sppd dalam bentuk array
        $pecah = explode("/", $nomor_spd);

        $nomor = 1;
        $kode = $pecah[1] . "/" . $pecah[2];
        $tahun = $pecah[3];
        $jenis_surat = 'st';
        $keterangan = auth()->user()->name . ', PPK auto dibuatkan STD setelah menyetujui usulan SPPD ' . $nomor_spd;

        // cek nomor surat terakhir
        $riwayat = RiwayatNomorSurat::kode($kode)->tahun($tahun)->jenis($jenis_surat)->orderBy('id', 'DESC')->limit(1)->first();
        if ($riwayat) {
            $nomor = (int) abs($riwayat->nomor) + 1;
        }

        $riwayat_nomor_surat = [
            'nomor' => $nomor,
            'kode' => $kode,
            'tahun' => $tahun,
            'jenis_surat' => $jenis_surat,
            'keterangan' => $keterangan
        ];

        // simpan riwayat nomor surat
        RiwayatNomorSurat::create($riwayat_nomor_surat);

        return $nomor . "/" . $kode . "/" . $tahun;
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->get = NULL;
        $this->params = NULL;
        $this->listppk = NULL;

        $this->status_spd = "";
        $this->pejabat_ppk = "";
        $this->alasan = "";

        $this->dispatch('close-modal', modal: $this->modal);
    }
}
