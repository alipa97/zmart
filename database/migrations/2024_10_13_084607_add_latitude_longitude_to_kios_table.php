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
            $table->decimal('latitude', 10, 8)->nullable(); // Menambahkan kolom latitude
            $table->decimal('longitude', 11, 8)->nullable(); // Menambahkan kolom longitude
        });
    }
    
    public function down()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']); // Menghapus kolom jika rollback
        });
    }
    
};
