<?php

namespace App\Livewire\Sppd;

use App\Models\SuratPerjalananDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class InputNilaiPencairan extends Component
{
    public $modal = "ModalInputNilaiPencairanSPPD";
    public $judul = "Input Nilai Pencairan SPPD";
    public $params;
    public $get;

    public $nilai_pencairan = 0;

    public function render()
    {
        if ($this->nilai_pencairan) {
            $this->nilai_pencairan = rupiah($this->nilai_pencairan);
        }

        return view('livewire.sppd.input-nilai-pencairan');
    }

    #[On('form-nilai-pencairan-sppd')]
    public function modal_form($params)
    {
        $this->params = decode_arr($params);
        $this->get = SuratPerjalananDinas::with(['pegawai', 'departemen', 'user'])->where('id', $this->params['sppd_id'])->first();
        $this->nilai_pencairan = rupiah($this->get->nilai_pencairan);
        // dd($this);
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $this->validate([
            'nilai_pencairan' => 'required'
        ]);

        SuratPerjalananDinas::where('id', $this->params['sppd_id'])->update([
            'nilai_pencairan' => rupiah($this->nilai_pencairan, false)
        ]);

        $this->dispatch('alert', type: 'success', title: 'Succesfully', message: 'Berhasil Input Nilai Pencairan SPPD');
        $this->_reset();
        $this->dispatch('load-datatable');
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->get = NULL;
        $this->params = NULL;
        $this->nilai_pencairan = 0;

        $this->dispatch('close-modal', modal: $this->modal);
    }
}
