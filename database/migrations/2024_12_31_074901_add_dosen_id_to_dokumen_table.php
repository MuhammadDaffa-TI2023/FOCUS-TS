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
        Schema::table('dokumen', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_id')->nullable()->after('keterangan_dosen');
            $table->foreign('dosen_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn('dosen_id');
        });
    }
};
