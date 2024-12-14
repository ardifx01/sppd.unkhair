<?php

namespace App\Livewire\Sppd;

use App\Models\SuratPerjalananDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailSppd extends Component
{
    public $modal = "ModalDetailSPPD";
    public $judul = "Detail Pengajuan SPPD";
    public $params;
    public $get;

    public function render()
    {
        return view('livewire.sppd.detail-sppd');
    }

    #[On('detail-pengajuan-sppd')]
    public function detail($params)
    {
        $this->params = decode_arr($params);
        $this->get = SuratPerjalananDinas::with(['pegawai', 'departemen', 'reviwer', 'user'])->where('id', $this->params['sppd_id'])->first();
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function _reset()
    {
        $this->resetErrorBag();
        $this->get = NULL;
        $this->params = NULL;
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
