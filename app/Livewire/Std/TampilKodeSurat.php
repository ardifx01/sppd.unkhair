<?php

namespace App\Livewire\Std;

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

        $kodesurat = KodeSurat::pencarian($this->pencarian)->orderBy('urutan', 'ASC')->paginate($this->perPage);
        return view('livewire.std.tampil-kode-surat', ['listdata' => $kodesurat]);
    }
}
