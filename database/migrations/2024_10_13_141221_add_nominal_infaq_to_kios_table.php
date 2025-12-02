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
            $table->decimal('nominal_infaq', 15, 2)->nullable()->after('keterangan'); // Menambahkan kolom nominal_infaq setelah kolom keterangan
        });
    }
    
    public function down()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->dropColumn('nominal_infaq');
        });
    }
    
};
