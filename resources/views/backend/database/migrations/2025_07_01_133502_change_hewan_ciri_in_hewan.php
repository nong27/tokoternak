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
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropColumn('hewan_ciri');
            $table->integer('hewan_umur');
            $table->enum('hewan_fisik', ['kurus', 'gemuk', 'ideal']);
            $table->string('hewan_warna');
            $table->enum('hewan_tanduk', ['panjang', 'pendek'])->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
