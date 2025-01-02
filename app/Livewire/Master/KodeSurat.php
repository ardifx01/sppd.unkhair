<?php

namespace App\Livewire\Master;

use App\Models\KodeSurat as ModelsKodeSurat;
use Livewire\Attributes\On;
use Livewire\Component;

class KodeSurat extends Component
{
    public $judul = "";
    public $modal = "ModalForm";

    public $mode = 'add';
    public $turunan = false;

    public $id;
    public $parent_id;
    public $kode;
    public $keterangan;

    public $parent_kode_surat = [];

    public function render()
    {
        return view('livewire.master.kode-surat');
    }

    public function kode_turunan()
    {
        $get = ModelsKodeSurat::where('id', $this->parent_id)->first();
        $this->kode = $get->kode . '.';
    }

    public function parent_kode_surat()
    {
        $this->parent_kode_surat = ModelsKodeSurat::where('parent_id', NULL)->orderBy('created_at', 'DESC')->get();
    }

    #[On('add-data')]
    public function add($title)
    {
        $this->judul = $title;
        $this->dispatch('open-modal', modal: $this->modal);
    }

    #[On('add-turunan')]
    public function add_turunan($title)
    {
        $this->judul = $title;
        $this->turunan = true;
        $this->parent_kode_surat();
        $this->dispatch('open-modal', modal: $this->modal);
    }

    #[On('edit-data')]
    public function edit($kodesurat_id)
    {
        $this->judul = "Edit Kode Surat";

        $get = ModelsKodeSurat::where('id', $kodesurat_id)->first();
        $this->id = $kodesurat_id;
        $this->parent_id = $get->parent_id;
        $this->kode = $get->kode;
        $this->keterangan = $get->keterangan;

        if ($this->parent_id) {
            $this->turunan = true;
            $this->parent_kode_surat();
        }

        $this->mode = 'edit';

        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $rules = [
            'kode' => 'required|unique:app_kode_surat,kode',
            'keterangan' => 'required',
        ];

        if ($this->mode == 'edit') {
            $rules['kode'] = 'required|unique:app_kode_surat,kode,' . $this->id;
        }

        if ($this->turunan) {
            $rules += [
                'parent_id' => 'required'
            ];
        }

        $this->validate($rules);
        // dd($this);
        $data = [
            'kode' => $this->kode,
            'keterangan' => $this->keterangan
        ];

        if ($this->turunan) {
            $data += ['parent_id' => $this->parent_id];
        }

        // dd($data);

        if ($this->mode == 'add') {
            ModelsKodeSurat::create($data);
            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Kode Surat Berhasil Ditambahkan');
        } else {
            ModelsKodeSurat::where('id', $this->id)->update($data);
            $this->dispatch('alert', type: 'success', title: 'Successfully', message: 'Kode Surat Berhasil Diperbarui');
        }

        $this->_reset();
        $this->dispatch('load-datatable');
        // $this->redirect(route('admin.kodesurat.index'));
    }

    public function _reset()
    {
        $this->resetErrorBag();

        $this->mode = 'add';
        $this->turunan = false;
        $this->id = '';
        $this->parent_id = '';
        $this->kode = '';
        $this->keterangan = '';
        $this->parent_kode_surat = [];

        $this->dispatch('close-modal', modal: $this->modal);
    }
}
