<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_lengkap' => 'Admin',
            'username' => 'admin',
            'telepon' => '081234567890',
            'email' => 'admin@gmail.com',
            'alamat' => 'Jl. Admin',
            'password' => Hash::make('password'), // Pastikan mengganti 'password' dengan kata sandi yang aman
            'role' => 'admin',
        ]);
    }
}