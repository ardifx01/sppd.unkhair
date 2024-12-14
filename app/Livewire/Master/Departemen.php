<?php

namespace App\Livewire\Master;

use App\Models\Departemen as ModelsDepartemen;
use Livewire\Attributes\On;
use Livewire\Component;

class Departemen extends Component
{
    public $judul = "Tambah Departemen";
    public $modal = "ModalForm";

    public $mode = 'add';
    public $id;
    public $departemen;
    public $lokasi;

    public function render()
    {
        return view('livewire.master.departemen');
    }

    #[On('add-data')]
    public function add($title)
    {
        $this->judul = $title;
        $this->dispatch('open-modal', modal: $this->modal);
    }

    #[On('edit-data')]
    public function edit($departemen_id)
    {
        $this->judul = 'Edit Departemen';

        $get = ModelsDepartemen::where('id', $departemen_id)->first();
        $this->departemen = $get->departemen;
        $this->lokasi = $get->lokasi;
        $this->id = $departemen_id;
        $this->mode = 'edit';

        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $this->validate([
            'departemen' => 'required'
        ]);

        if ($this->mode == 'add') {
            ModelsDepartemen::create([
                'departemen' => $this->departemen,
                'lokasi' => $this->lokasi
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Departemen Berhasil Ditambahkan');
        } else {
            ModelsDepartemen::where('id', $this->id)->update([
                'departemen' => $this->departemen,
                'lokasi' => $this->lokasi
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Departemen Berhasil Diperbarui');
        }

        $this->dispatch('load-datatable');
        $this->_reset();
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->departemen = '';
        $this->lokasi = '';
        $this->id = '';
        $this->mode = 'add';
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
