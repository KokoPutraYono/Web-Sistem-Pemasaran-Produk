<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Komen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk')->index();
            $table->string('nama_produk');
            $table->string('email')->unique();
            $table->string('nama');
            $table->string('komentar', 700);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komen');
    }
}
