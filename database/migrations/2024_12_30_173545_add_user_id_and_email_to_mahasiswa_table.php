<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable(); // Kolom user_id
            $table->string('email')->after('nama')->unique()->nullable();  // Kolom email

            // Tambahkan foreign key untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Hapus foreign key dan kolom jika migrasi di-rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('email');
        });
    }
};

