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
        Schema::create('detailtransaksi', function (Blueprint $table) {
            $table->id('detailtransaksi_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('hewan_id');
            $table->integer('jumlah_beli');
            $table->float('harga_detail');

            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hewan_id')->references('hewan_id')->on('hewan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailtransaksi');
    }
};
