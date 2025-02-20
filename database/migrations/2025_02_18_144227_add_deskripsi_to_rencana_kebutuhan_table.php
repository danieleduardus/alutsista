<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('judul'); // Menambahkan kolom deskripsi
        });
    }

    public function down()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->dropColumn('deskripsi'); // Menghapus kolom jika rollback
        });
    }
};
