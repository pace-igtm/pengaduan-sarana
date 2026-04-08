<?php 
 
namespace App\Models; 
 
use Illuminate\Foundation\Auth\User as Authenticatable; // Wajib untuk Login 
 
use Illuminate\Notifications\Notifiable;
class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'siswa';
    protected $primaryKey = 'nis'; // PK Bukan 'id' tapi 'nis'
    public $incrementing = false; // Karena Nis diinput manual, bukan auto-increment
    protected $keyType = 'int'; // Tipe data NIS adalah integer
    protected $guarded =[];

    // Relasi: Satu siswa punya banyak laporan
    public function inputAspirasi() {
        return$this->hasMany(InputAspirasi::class,'nis', 'nis');
    }
}