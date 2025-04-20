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
            $table->dateTime('tanggal_selesai')->nullable()->change(); // Mengizinkan NULL pada kolom tanggal_selesai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('tanggal_selesai')->nullable(false)->change(); // Menetapkan kembali agar tidak NULL
        });
    }
};
