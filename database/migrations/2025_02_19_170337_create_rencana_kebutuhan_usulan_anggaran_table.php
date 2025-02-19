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
        Schema::create('rencana_kebutuhan_usulan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usulan_anggaran_id')->constrained('usulan_anggaran')->onDelete('cascade');
            $table->foreignId('rencana_kebutuhan_id')->constrained('rencana_kebutuhan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_kebutuhan_usulan_anggaran');
    }
};
