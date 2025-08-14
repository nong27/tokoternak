<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->datetime('tanggal_pesan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status_transaksi', ['menunggu pembayaran', 'diproses', 'selesai', 'batal', 'in cart', 'verifikasi pembayaran', 'dikirim', 'belum diterima']);
            $table->unsignedBigInteger('pelanggan_id');
            $table->float('total_bayar');
            $table->float('ongkir')->default(0);
            $table->integer('batas_bayar');

            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan')->onUpdate('cascade')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
