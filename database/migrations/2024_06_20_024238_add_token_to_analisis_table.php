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
        Schema::table('analisis_llm', function (Blueprint $table) {
            $table->integer('token')->nullable();
            $table->integer('temperature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('analisis_llm', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('temperature');
        });
    }
};
