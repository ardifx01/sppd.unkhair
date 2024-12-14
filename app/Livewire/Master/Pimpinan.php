<?php

namespace App\Livewire\Master;

use App\Models\Pimpinan as ModelsPimpinan;
use Livewire\Attributes\On;
use Livewire\Component;

class Pimpinan extends Component
{
    public $judul = "Tambah Pimpinan";
    public $modal = "ModalForm";

    public $mode = 'add';
    public $id;
    public $nama_pimpinan;
    public $nip;
    public $golongan;
    public $jabatan;
    public $ppk = 0;

    public function render()
    {
        return view('livewire.master.pimpinan');
    }

    #[On('add-data')]
    public function add($title)
    {
        $this->judul = $title;
        $this->dispatch('open-modal', modal: $this->modal);
    }

    #[On('edit-data')]
    public function edit($pimpinan_id)
    {
        $this->judul = 'Edit Pimpinan';

        $get = ModelsPimpinan::where('id', $pimpinan_id)->first();
        $this->nama_pimpinan = $get->nama_pimpinan;
        $this->nip = $get->nip;
        $this->golongan = $get->golongan;
        $this->jabatan = $get->jabatan;
        $this->ppk = $get->ppk;
        $this->id = $pimpinan_id;
        $this->mode = 'edit';

        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $this->validate([
            'nama_pimpinan' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
        ]);

        if ($this->mode == 'add') {
            ModelsPimpinan::create([
                'nama_pimpinan' => $this->nama_pimpinan,
                'nip' => $this->nip,
                'golongan' => $this->golongan,
                'jabatan' => $this->jabatan,
                'ppk' => $this->ppk,
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Pimpinan Berhasil Ditambahkan');
        } else {
            ModelsPimpinan::where('id', $this->id)->update([
                'nama_pimpinan' => $this->nama_pimpinan,
                'nip' => $this->nip,
                'golongan' => $this->golongan,
                'jabatan' => $this->jabatan,
                'ppk' => $this->ppk,
            ]);

            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Pimpinan Berhasil Diperbarui');
        }

        $this->dispatch('load-datatable');
        $this->_reset();
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->nama_pimpinan = '';
        $this->nip = '';
        $this->golongan = '';
        $this->jabatan = '';
        $this->ppk = 0;
        $this->id = '';
        $this->mode = 'add';
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
