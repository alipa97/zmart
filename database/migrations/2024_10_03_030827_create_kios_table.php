<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kios', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kios');
            $table->string('nama_kios')->nullable(); // Kolom nama_kios tidak wajib diisi
            $table->string('alamat');
            $table->string('rt', 10);
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('no_hp')->nullable(); // No HP tidak wajib diisi
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable(); // Menyimpan path foto
            // $table->string('nama_pemilik'); // Menyimpan nama pemilik kios
            // $table->string('tempat_lahir')->nullable(); // Tempat lahir (opsional)
            // $table->date('tanggal_lahir')->nullable(); // Tanggal lahir (opsional)
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('kios');
    }
    
};
