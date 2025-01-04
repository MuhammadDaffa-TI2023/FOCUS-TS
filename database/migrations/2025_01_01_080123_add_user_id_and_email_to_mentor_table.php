<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Tambahkan kolom user_id
            $table->string('email')->nullable()->after('user_id'); // Tambahkan kolom email

            // Definisikan relasi foreign key untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('mentor', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus relasi foreign key
            $table->dropColumn(['user_id', 'email']); // Hapus kolom user_id dan email
        });
    }
};
