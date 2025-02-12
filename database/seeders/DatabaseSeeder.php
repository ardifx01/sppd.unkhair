<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->role();
    }

    public function users()
    {
        $users = [
            'name' => 'Muhamad Yasir',
            'email' => 'iryas@admin.com',
            'username' => 'yasir@admin',
            'password' => Hash::make('109696'),
            'user_simak' => 0,
            'is_active' => 1
        ];

        User::create($users);
    }

    public function role()
    {
        // $role = [
        //     'name' => 'keuangan',
        //     'description' => 'Role user Keuangan bertugas untuk input Nilai Pencairan SPPD',
        // ];

        $role = [
            'name' => 'admin-st-dk',
            'description' => 'Role user pembuat Surat Tugas Dalam Kota',
        ];

        Role::create($role);
    }
}
