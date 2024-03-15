<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_saldos', function (Blueprint $table) {
            $table->id();
            $table->integer('idr'); // Price in IDR
            $table->decimal('usd', 10, 2); // Price in USD with 2 decimal places
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
        Schema::dropIfExists('daftar_saldos');
    }
};
