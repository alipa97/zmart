<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNominalInInfaqKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('infaq_kios', function (Blueprint $table) {
            // Mengubah tipe kolom nominal menjadi unsignedInteger
            $table->unsignedInteger('nominal')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infaq_kios', function (Blueprint $table) {
            // Mengembalikan tipe kolom nominal ke decimal(15, 2)
            $table->decimal('nominal', 15, 2)->change();
        });
    }
}
