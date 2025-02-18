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
        Schema::create('rencana_kebutuhan', function (Blueprint $table) {
            $table->id(); // auto-increment primary key (int 10)
            $table->string('nomor', 10)->unique();
            $table->string('judul', 200)->notNull();
            $table->unsignedBigInteger('jenis_kebutuhan_id');
            $table->unsignedBigInteger('prioritas_id');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('jenis_kebutuhan_id')->references('id')->on('jenis_kebutuhan')->onDelete('cascade');
            $table->foreign('prioritas_id')->references('id')->on('prioritas_kebutuhan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_kebutuhan');
    }
};
