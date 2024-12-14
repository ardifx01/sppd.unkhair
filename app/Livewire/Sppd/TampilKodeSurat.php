<?php

namespace App\Livewire\Sppd;

use App\Models\KodeSurat;
use Livewire\Component;
use Livewire\WithPagination;

class TampilKodeSurat extends Component
{
    use WithPagination;

    public $pencarian = '';
    public $perPage = 10;

    public function render()
    {
        if ($this->pencarian) {
            $this->resetPage();
        }

        $kodesurat = KodeSurat::pencarian($this->pencarian)->orderBy('created_at', 'ASC')->paginate($this->perPage);
        return view('livewire.sppd.tampil-kode-surat', ['listdata' => $kodesurat]);
    }
}
