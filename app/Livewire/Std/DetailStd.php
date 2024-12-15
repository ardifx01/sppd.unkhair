<?php

namespace App\Livewire\Std;

use App\Models\SuratTugasDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailStd extends Component
{
    public $modal = "ModalDetailSTD";
    public $judul = "Detail Surat Tugas";
    public $params;
    public $get;

    public function render()
    {
        return view('livewire.std.detail-std');
    }

    #[On('detail-std')]
    public function detail($params)
    {
        $this->params = decode_arr($params);
        $this->get = SuratTugasDinas::with(['pegawai', 'departemen', 'user'])->where('id', $this->params['stugas_id'])->first();
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
