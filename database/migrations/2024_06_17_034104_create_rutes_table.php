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
        Schema::create('rute', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rute', 50);
            $table->unsignedBigInteger('id_halte_awal');
            $table->unsignedBigInteger('id_halte_akhir');
            $table->unsignedBigInteger('id_halte_1')->nullable();
            $table->unsignedBigInteger('id_halte_2')->nullable();
            $table->unsignedBigInteger('id_halte_3')->nullable();
            $table->unsignedBigInteger('id_halte_4')->nullable();
            $table->unsignedBigInteger('id_halte_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute');
    }
};
