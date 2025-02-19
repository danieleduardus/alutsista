<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('usulan_anggaran', function (Blueprint $table) {
            $table->string('judul', 255)->after('nomor'); // Tambahkan kolom judul
        });
    }

    public function down()
    {
        Schema::table('usulan_anggaran', function (Blueprint $table) {
            $table->dropColumn('judul');
        });
    }
};
