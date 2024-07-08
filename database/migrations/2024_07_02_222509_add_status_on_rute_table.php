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
        Schema::table('rute', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('id_halte_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rute', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};