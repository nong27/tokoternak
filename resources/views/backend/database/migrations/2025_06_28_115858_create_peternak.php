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
        Schema::create('peternak', function (Blueprint $table) {
            $table->id('peternak_id');
            $table->unsignedBigInteger('user_id');
            $table->string('peternak_nama');
            $table->enum('peternak_jk', ['P', 'L']);
            $table->string('peternak_alamat');
            $table->string('peternak_hp', 12);
            $table->string('peternak_foto');
            $table->string('peternak_tempatlahir');
            $table->string('peternak_tgllahir');

            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peternak');
    }
};
