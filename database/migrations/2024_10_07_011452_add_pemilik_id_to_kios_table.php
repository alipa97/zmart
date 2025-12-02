<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPemilikIdToKiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kios', function (Blueprint $table) {
            $table->unsignedBigInteger('pemilik_id')->after('id'); // Kolom pemilik_id setelah kolom id
            $table->foreign('pemilik_id')->references('id')->on('pemilik')->onDelete('cascade');
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
            $table->dropForeign(['pemilik_id']);
            $table->dropColumn('pemilik_id');
        });
    }
}
