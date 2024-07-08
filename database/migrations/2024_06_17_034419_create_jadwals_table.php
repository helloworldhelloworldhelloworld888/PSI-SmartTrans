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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bis')->constrained('bis')->onDelete('cascade')->onUpdate('cascade');
            $table->time('jam_keberangkatan_1')->nullable();
            $table->time('jam_keberangkatan_2')->nullable();
            $table->time('jam_keberangkatan_3')->nullable();
            $table->time('jam_keberangkatan_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
