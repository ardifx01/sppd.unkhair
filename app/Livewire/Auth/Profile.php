<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Profile extends Component
{
    public $judul = "Edit Akun";
    public $modal = "ModalEditAkun";
    public $get;

    public $id, $name, $email, $username, $password_now, $password_lama, $password_baru;

    public function render()
    {
        return view('livewire.auth.profile');
    }

    public function editAkun()
    {
        $this->get = auth()->user();

        $this->id = $this->get->id;
        $this->name = $this->get->name;
        $this->email = $this->get->email;
        $this->username = $this->get->username;
        $this->password_now = $this->get->password;

        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'username' => 'required',
        ];

        if ($this->password_baru && count($this->password_baru) > 3) {
            $rules += [
                'password_lama' => 'required|min:4'
            ];
        }

        $this->validate($rules);

        if ($this->password_baru && !password_verify($this->password_baru, $this->password_now)) {
            $this->addError("password_lama", "Password Lama tidak sesuai!");
        }

        if (!$this->getErrorBag()->all()) {
            $data = [
                'name' => $this->name,
                'email' => $this->email
            ];

            if ($this->password_baru) {
                $data += ['password' => password_hash($this->password_baru, PASSWORD_DEFAULT)];
            }

            auth()->user()->update($data);
            $this->dispatch('alert', type: 'success', title: 'Successfuly', message: 'Edit Akun Berhasil Disimpan.');
            $this->_reset();
        }
    }

    public function _reset()
    {
        $this->get = NULL;
        $this->name = NULL;
        $this->email = NULL;
        $this->username = NULL;
        $this->password_now = NULL;
        $this->password_lama = NULL;
        $this->password_baru = NULL;
        $this->dispatch('close-modal', modal: $this->modal);
    }
}
