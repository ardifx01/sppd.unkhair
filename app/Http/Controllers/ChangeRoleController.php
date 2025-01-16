<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangeRoleController extends Controller
{
    //
    public function index($role)
    {
        request()->session()->put([
            'role' => $role
        ]);

        alert()->success('Success', 'Sukses ganti peran, Selamat datang ' . auth()->user()->name);

        if ($role == 'keuangan') {
            dd($role);
            return redirect(route('keuangan.dashboard'));
        }

        return redirect(route('admin.dashboard'));
    }
}
