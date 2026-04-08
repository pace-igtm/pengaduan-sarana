<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\InputAspirasi; 
use App\Models\Aspirasi; 
use App\Models\Kategori; 
 
class SiswaController extends Controller 
{ 
    public function index() { 
        // Ambil data user yang sedang login 
        $nis = Auth::guard('siswa')->user()->nis; 
         
        // Ambil histori aspirasi siswa tersebut + relasi aspirasi & kategori 
        $histori = InputAspirasi::where('nis', $nis) 
                    ->with('aspirasi', 'kategori') 
                    ->latest() 
                    ->get(); 
         
        $kategori = Kategori::all(); // Untuk dropdown di form 
 
        return view('siswa.dashboard', compact('histori', 'kategori')); 
    } 
 
    public function store(Request $request) { 
        $request->validate([ 
            'lokasi' => 'required', 
            'ket' => 'required', 
            'id_kategori' => 'required' 
        ]); 
 
        // 1. Simpan ke Input Aspirasi 
        $input = InputAspirasi::create([ 
            'nis' => Auth::guard('siswa')->user()->nis, 
            'id_kategori' => $request->id_kategori, 
            'lokasi' => $request->lokasi, 
            'ket' => $request->ket 
        ]); 
 
        // 2. Otomatis buat status 'Menunggu' di tabel Aspirasi 
        Aspirasi::create([ 
            'id_pelaporan' => $input->id_pelaporan, 
            'status' => 'Menunggu', 'id_kategori' => $request->id_kategori
        ]);

        return back()->with('success', 'Laporan berhasil dikirim!');
    }
}