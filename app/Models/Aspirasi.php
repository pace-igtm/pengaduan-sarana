<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    protected $guarded = [];

    // Relasi balik ke InputAspirasi
    public function inputAspirasi(){
        return $this->belongsTo(InputAspirasi::class,'id_pelaporan', 'Id_pelaporan');
    }
}