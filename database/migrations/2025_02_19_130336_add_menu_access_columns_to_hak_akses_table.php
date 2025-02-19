<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->boolean('menu_rencana_kebutuhan')->default(0)->after('status');
            $table->boolean('menu_usulan_anggaran')->default(0)->after('menu_rencana_kebutuhan');
            $table->boolean('menu_rfq')->default(0)->after('menu_usulan_anggaran');
            $table->boolean('menu_kontrak')->default(0)->after('menu_rfq');
        });
    }

    public function down()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->dropColumn(['menu_rencana_kebutuhan', 'menu_usulan_anggaran', 'menu_rfq', 'menu_kontrak']);
        });
    }
};
