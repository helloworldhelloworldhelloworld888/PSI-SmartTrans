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
        Schema::create('bis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rute')->constrained('rute')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_bis', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bis');
    }
};
