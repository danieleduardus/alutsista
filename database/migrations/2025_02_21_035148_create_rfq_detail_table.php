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
        Schema::create('rfq_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfq_id')->constrained('rfq')->onDelete('cascade');
            $table->string('nama_barang', 255);
            $table->integer('quantity');
            $table->text('spesifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfq_detail');
    }
};
