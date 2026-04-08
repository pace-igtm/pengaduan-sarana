<?php 
 
use Illuminate\Database\Migrations\Migration; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Support\Facades\Schema; 
 
return new class extends Migration 
{ 
    public function up() 
    { 
        // 1. Tabel Admin 
        Schema::create('admin', function (Blueprint $table) { 
            $table->id();  
            $table->string('username')->unique(); 
            $table->string('password'); 
            $table->timestamps(); 
        }); 
 
        // 2. Tabel Siswa 
        Schema::create('siswa', function (Blueprint $table) { 
            $table->integer('nis')->primary(); // Primary Key Manual (Integer) 
            $table->string('kelas', 10); 
            $table->string('password'); // Untuk Login 
            $table->timestamps(); 
        }); 
 
        // 3. Tabel Kategori 
        Schema::create('kategori', function (Blueprint $table) { 
            $table->integer('id_kategori')->autoIncrement(); // PK Auto Increment 
            $table->string('ket_kategori', 30); 
            $table->timestamps(); 
        }); 
 
        // 4. Tabel Input Aspirasi (Laporan Awal) 
        Schema::create('input_aspirasi', function (Blueprint $table) { 
            $table->integer('id_pelaporan')->autoIncrement(); // PK 
            $table->integer('nis'); // FK 
            $table->integer('id_kategori'); // FK 
            $table->string('lokasi', 50); 
            $table->string('ket', 50); 
            $table->timestamps(); 
 
            // Foreign Keys 
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade'); 
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori'); 
        }); 
 
        // 5. Tabel Aspirasi (Status & Proses) 
        Schema::create('aspirasi', function (Blueprint $table) { 
            $table->integer('id_aspirasi')->autoIncrement(); // PK 
            $table->integer('id_pelaporan'); // FK 
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu'); 
            $table->integer('id_kategori'); // Sesuai gambar 
            $table->text('feedback')->nullable(); // Umpan Balik 
            $table->timestamps(); 
 
            // Foreign Keys 
            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onDelete('cascade'); 
        }); 
    } 
 
    public function down() 
    { 
        Schema::dropIfExists('aspirasi'); 
        Schema::dropIfExists('input_aspirasi'); 
        Schema::dropIfExists('kategori'); 
        Schema::dropIfExists('siswa'); 
        Schema::dropIfExists('admin'); 
    } 
}; 