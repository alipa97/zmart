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
        Schema::table('kios', function (Blueprint $table) {
            $table->year('tahun')->nullable(); // Menambahkan kolom tahun, nullable jika tidak wajib diisi
        });
    }

    public function down()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->dropColumn('tahun'); // Menghapus kolom tahun jika migration dibatalkan
        });
    }
};
