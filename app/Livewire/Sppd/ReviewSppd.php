<?php

namespace App\Livewire\Sppd;

use App\Models\Pimpinan;
use App\Models\SuratPerjalananDinas;
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

        if ($this->status_spd != '200') {
            $rules += ['alasan' => 'required'];
            unset($rules['pejabat_ppk']);
        }
        $this->validate($rules);

        $pejabat_ppk = $this->pejabat_ppk ? json_encode(decode_arr($this->pejabat_ppk)) : NULL;
        SuratPerjalananDinas::where('id', $this->params['sppd_id'])->update([
            'status_spd' => $this->status_spd,
            'pejabat_ppk' => $pejabat_ppk,
            'tanggal_review' => now(),
            'reviewer_id' => auth()->user()->id,
            'alasan' => $this->alasan,
        ]);

        $this->dispatch('alert', type: 'success', title: 'Succesfully', message: 'Berhasil Review Pengajuan SPPD');
        $this->_reset();
        $this->dispatch('load-datatable');
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
