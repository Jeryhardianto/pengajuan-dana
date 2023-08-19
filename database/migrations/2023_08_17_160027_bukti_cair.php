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
        Schema::create('bukti_cair', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained()
                    ->references('id')
                    ->on('pengajuans')
                    ->onDelete('cascade');
            $table->string('jenis_transaksi')->nullable();
            $table->integer('total_cair')->nullable();
            $table->dateTime('tanggal_cair');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_cair');
    }
};
