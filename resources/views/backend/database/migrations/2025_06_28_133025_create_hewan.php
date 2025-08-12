<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hewan', function (Blueprint $table) {
            $table->id('hewan_id');
            $table->unsignedBigInteger('jenishewan_id');
            $table->string('hewan_nama');
            $table->string('hewan_deskripsi');
            $table->string('hewan_berat');
            $table->text('hewan_ciri');
            $table->float('hewan_harga');
            $table->text('hewan_gambar');
            $table->text('hewan_jumlah');

            $table->foreign('jenishewan_id')->references('jenishewan_id')->on('jenishewan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan');
    }
};
