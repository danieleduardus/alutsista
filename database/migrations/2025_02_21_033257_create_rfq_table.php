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
        Schema::create('rfq', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulan_anggaran_id')->constrained('usulan_anggaran')->onDelete('cascade');
            $table->date('tanggal_batas_pemenuhan');
            $table->text('catatan_pengiriman')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfq');
    }
};
