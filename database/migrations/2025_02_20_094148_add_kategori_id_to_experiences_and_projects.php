<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan kategori_id ke tabel experiences
        Schema::table('experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('province_id'); // Sesuaikan posisi kolom
            $table->foreign('kategori_id')->references('id')->on('exp_kategori')->onDelete('cascade');
        });

        // Menambahkan kategori_id ke tabel projects
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('client_id'); // Sesuaikan posisi kolom
            $table->foreign('kategori_id')->references('id')->on('exp_kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key dari experiences
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });

        // Hapus foreign key dari projects
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
