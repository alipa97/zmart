<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNominalInfaqFromKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->dropColumn('nominal_infaq'); // Menghapus kolom nominal_infaq
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->decimal('nominal_infaq', 15, 2)->nullable(); // Menambahkan kembali kolom nominal_infaq jika rollback
        });
    }
}
