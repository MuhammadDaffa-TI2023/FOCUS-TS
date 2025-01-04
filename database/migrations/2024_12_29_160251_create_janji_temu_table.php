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
        Schema::create('janji_temu', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');  
            $table->time('jam'); 
            $table->enum('status', ['Tolak', 'Setuju', 'Proses'])->default('Proses');
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->foreign('dosen_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('dosen'); 
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreign('mahasiswa_id')->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('mahasiswa');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janji_temu');
    }
};
