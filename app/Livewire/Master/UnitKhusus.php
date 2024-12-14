<?php

namespace App\Livewire\Master;

use App\Models\Departemen;
use Livewire\Attributes\On;
use Livewire\Component;

class UnitKhusus extends Component
{
    public $judul = "Tambah Unit Bagian";
    public $modal = "ModalForm";

    public $mode = 'add';
    public $id;
    public $parent_id;
    public $unit_bagian;
    public $lokasi;

    public $unitpusat;

    public function mount($params)
    {
        $this->parent_id = data_params($params, 'parent_id');
        $get = Departemen::where('id', $this->parent_id)->orderBy('created_at', 'ASC')->first();
        $this->unitpusat = $get->departemen;
    }

    public function render()
    {
        return view('livewire.master.unit-khusus');
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
        $this->judul = 'Edit Unit Bagian';

        $get = Departemen::where('id', $departemen_id)->first();
        $this->unit_bagian = $get->departemen;
        $this->lokasi = $get->lokasi;
        $this->id = $departemen_id;
        $this->mode = 'edit';

        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $this->validate([
            'unit_bagian' => 'required'
        ]);

        if ($this->mode == 'add') {
            Departemen::create([
                'parent_id' => $this->parent_id,
                'departemen' => $this->unit_bagian,
                'lokasi' => $this->lokasi
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Unit Bagian Berhasil Ditambahkan');
        } else {
            Departemen::where('id', $this->id)->update([
                'departemen' => $this->unit_bagian,
                'lokasi' => $this->lokasi
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Unit Bagian Berhasil Diperbarui');
        }

        $this->dispatch('load-datatable');
        $this->_reset();
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->unit_bagian = '';
        $this->lokasi = '';
        $this->id = '';
        $this->mode = 'add';
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
