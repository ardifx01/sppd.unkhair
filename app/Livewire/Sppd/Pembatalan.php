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
    public $spd_id;
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
        $this->resetErrorBag();

        $this->get = NULL;
        $this->spd_id = NULL;
        $this->nomor_spd = NULL;
        $this->form = 'check';
        $this->status_spd = "";
        $this->pejabat_ppk = "";
        $this->alasan = "";
        $this->currentStep = 1;
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function check()
    {
        $this->validate([
            'nomor_spd' => 'required'
        ]);

        $status_spd = ['102', '200'];
        $this->get = SuratPerjalananDinas::with('surat_tugas')->pencarian($this->nomor_spd)->status_spd($status_spd)->first();
        if (!$this->get) {
            $this->dispatch('alert', type: 'warning', message: 'SPPD dengan Nomor ' . $this->nomor_spd . ' tidak ditemukan!');
        } else {
            $this->form = 'save';
            $this->next(2);
        }
    }

    public function save()
    {
        $this->validate([
            'alasan' => ['required', function ($attribute, $value, $fail) {
                if (str_word_count($value) < 3) {
                    $fail("The $attribute must have at least 3 words.");
                }
            }]
        ]);

        $this->get->update([
            'status_spd' => '409',
            'tanggal_review' => now(),
            'reviewer_id' => auth()->user()->id,
            'alasan' => $this->alasan,
        ]);

        if ($this->get->surat_tugas) {
            $this->get->surat_tugas->update([
                'status_std' => '409'
            ]);
        }

        $this->dispatch('alert', type: 'success', title: 'Succesfully', message: 'SPPD Telah Dibatalkan');
        $this->_reset();
        $this->dispatch('load-datatable');
    }

    public function next($step)
    {
        $this->currentStep = $step;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->get = NULL;
        $this->spd_id = NULL;
        $this->nomor_spd = NULL;
        $this->form = 'check';

        $this->status_spd = "";
        $this->pejabat_ppk = "";
        $this->alasan = "";
        $this->currentStep = 1;

        $this->dispatch('close-modal', modal: $this->modal);
    }
}
