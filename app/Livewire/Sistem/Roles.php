<?php

namespace App\Livewire\Sistem;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $judul = "Role Pengguna";
    public $modal = "ModalUpdateRole";
    public $id;
    public $name;
    public $description;
    public $mode = "add";
    public function render()
    {
        $listrole = Role::select('id', 'name', 'description')->orderBy('id', 'ASC')->get();
        return view('livewire.sistem.roles-index', ['listdata' => $listrole])
            ->extends('layouts.backend')
            ->section('content');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $message = '';

        if ($this->mode == 'add') {
            Role::create(
                [
                    'name' => $this->name,
                    'description' => $this->description
                ]
            );

            $message = 'Role berhasil ditambahkan.';
        }

        if ($this->mode == 'edit') {
            Role::where('id', $this->id)->update(
                [
                    'name' => $this->name,
                    'description' => $this->description
                ]
            );
            $message = 'Role berhasil ed edit.';
        }
        $this->dispatch('alert', type: 'success', title: 'Successfuly', message: $message);
        $this->_reset();
    }

    public function add()
    {
        $this->mode = "add";
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function edit($id)
    {
        // dd($id);
        $get = Role::where('id', $id)->first();
        $this->id = $get->id;
        $this->name = $get->name;
        $this->description = $get->description;
        $this->mode = "edit";
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function _reset()
    {
        $this->resetErrorBag();
        $this->name = "";
        $this->description = "";
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
