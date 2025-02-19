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
        Schema::table('usulan_anggaran', function (Blueprint $table) {
            // Ubah tipe data 'jumlah' menjadi DECIMAL(15,2) untuk representasi money
            $table->decimal('jumlah', 15, 2)->change();

            // Ubah tipe data 'realisasi' menjadi DECIMAL(15,2) dan beri default NULL
            $table->decimal('realisasi', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usulan_anggaran', function (Blueprint $table) {
            // Kembalikan tipe data ke DECIMAL(10,2) seperti sebelumnya
            $table->decimal('jumlah', 10, 2)->change();
            $table->decimal('realisasi', 10, 2)->nullable(false)->change();
        });
    }
};
