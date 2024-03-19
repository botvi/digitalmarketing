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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('subkategori_id')->constrained('sub_kategoris')->onDelete('cascade');
            $table->longText('keterangan');
            $table->longText('deskripsi');
            $table->json('produk');
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
        Schema::dropIfExists('produks');
    }
};
