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
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('tanggal_mulai')->nullable()->change(); // Mengizinkan NULL pada kolom tanggal_mulai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('tanggal_mulai')->nullable(false)->change(); // Menetapkan kembali agar tidak NULL
        });
    }
};
