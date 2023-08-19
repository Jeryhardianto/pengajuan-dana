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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('finance1_id')->nullable();
            $table->string('finance2_id')->nullable();
            $table->string('direktur_id')->nullable();
            $table->text('nama_kegiatan')->nullable();
            $table->string('nama_pj')->nullable();
            $table->text('tujuan')->nullable();
            $table->integer('total_biaya')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status')->nullable();
            $table->boolean('bukti');
            $table->dateTime('tanggaldiajukan')->nullable();
            $table->dateTime('tanggaldiperiksa')->nullable();
            $table->dateTime('tanggaldiselesaiperiksa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
