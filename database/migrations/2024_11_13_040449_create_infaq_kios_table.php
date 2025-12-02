<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfaqKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infaq_kios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kios_id'); // Foreign key untuk menghubungkan ke tabel kios
            $table->decimal('nominal', 15, 2); // Kolom nominal infaq
            $table->date('tanggal'); // Kolom tanggal infaq
            $table->string('via'); // Kolom via untuk metode pembayaran atau keterangan lainnya
            $table->timestamps(); // Untuk created_at dan updated_at
            
            // Definisikan foreign key yang menghubungkan kios_id ke id pada tabel kios
            $table->foreign('kios_id')->references('id')->on('kios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infaq_kios');
    }
}
