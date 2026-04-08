<?php 
 
namespace App\Models; 
 
use Illuminate\Foundation\Auth\User as Authenticatable; // Wajib untuk Login 
use Illuminate\Notifications\Notifiable; 
 
class Admin extends Authenticatable 
{ 
    use Notifiable; 
 
    protected $table = 'admin'; // Arahkan ke tabel admin 
    protected $guarded = []; // Izinkan semua kolom diisi
}