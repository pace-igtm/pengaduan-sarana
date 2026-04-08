<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run() 
    { 
        // 1. Buat Akun Admin 
        Admin::create([ 
            'username' => 'admin', 
            'password' => Hash::make('admin123') // Password terenkripsi 
        ]); 
 
        // 2. Buat Akun Siswa 
        Siswa::create([ 
            'nis' => 12345, // NIS (Username login siswa) 
            'kelas' => 'XII RPL', 
            'password' => Hash::make('siswa123') 
        ]); 
 
        // 3. Buat Kategori 
        Kategori::create(['ket_kategori' => 'Sarana Kelas']); 
        Kategori::create(['ket_kategori' => 'Kebersihan']); 
        Kategori::create(['ket_kategori' => 'Kantin']); 
    }
}
