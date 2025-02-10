<?php

namespace App\Livewire\Sppd;

use App\Models\SuratPerjalananDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class Pembatalan extends Component
{
    public $modal = "ModalPembatalanSPPD";
    public $judul = "Pembatalan SPPD";

    public $form  = "check";

    public $currentStep = 1;

    public $get = [];
    public $nomor_spd;
    public $status_spd;
    public $pejabat_ppk;
    public $alasan;

    public function render()
    {
        return view('livewire.sppd.pembatalan');
    }

    #[On('pembatalan-sppd')]
    public function tampil_form()
    {
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function check()
    {
        $this->validate([
            'nomor_spd' => 'required|exists:app_surat_perjalanan_dinas,nomor_spd'
        ]);

        $this->get = SuratPerjalananDinas::pencarian($this->nomor_spd)->first();
        $this->dispatch('alert', type: 'warning', message: 'Sedang pengembangan..');
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->get = NULL;
        $this->nomor_spd = NULL;
        $this->form = 'check';

        $this->status_spd = "";
        $this->pejabat_ppk = "";
        $this->alasan = "";

        $this->dispatch('close-modal', modal: $this->modal);
    }
}
