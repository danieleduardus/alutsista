<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->string('nomor', 20)->change(); // Mengubah panjang varchar menjadi 20
        });
    }

    public function down()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->string('nomor', 10)->change(); // Jika rollback, kembali ke ukuran sebelumnya (sesuaikan dengan ukuran awal)
        });
    }
};
