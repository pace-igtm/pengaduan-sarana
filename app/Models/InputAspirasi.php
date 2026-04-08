<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';
    protected $primaryKey = 'id_pelaporan'; 
    protected $guarded = []; 
 
    // Relasi ke Siswa 
    public function siswa() { 
        return $this->belongsTo(Siswa::class, 'nis', 'nis'); 
    } 
 
    // Relasi ke Kategori 
    public function kategori() { 
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori'); 
    } 
 
    // Relasi ke Status Aspirasi (One to One) 
    public function aspirasi() { 
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan'); 
    } 
} 