<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->boolean('mengelola_master_data')->default(0)->after('menu_kontrak');
            $table->boolean('membuat_rencana_kebutuhan')->default(0)->after('mengelola_master_data');
            $table->boolean('menentukan_prioritas_rencana_kebutuhan')->default(0)->after('membuat_rencana_kebutuhan');
            $table->boolean('membuat_usulan_anggaran')->default(0)->after('menentukan_prioritas_rencana_kebutuhan');
            $table->boolean('mengubah_usulan_anggaran')->default(0)->after('membuat_usulan_anggaran');
            $table->boolean('menyetujui_usulan_anggaran')->default(0)->after('mengubah_usulan_anggaran');
            $table->boolean('membuat_rfq')->default(0)->after('menyetujui_usulan_anggaran');
            $table->boolean('mengubah_rfq')->default(0)->after('membuat_rfq');
            $table->boolean('menyetujui_dan_mempublikasikan_rfq')->default(0)->after('mengubah_rfq');
            $table->boolean('memilih_vendor_dan_penawaran')->default(0)->after('menyetujui_dan_mempublikasikan_rfq');
            $table->boolean('menandatangani_kontrak')->default(0)->after('memilih_vendor_dan_penawaran');
        });
    }

    public function down()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->dropColumn([
                'mengelola_master_data',
                'membuat_rencana_kebutuhan',
                'menentukan_prioritas_rencana_kebutuhan',
                'membuat_usulan_anggaran',
                'mengubah_usulan_anggaran',
                'menyetujui_usulan_anggaran',
                'membuat_rfq',
                'mengubah_rfq',
                'menyetujui_dan_mempublikasikan_rfq',
                'memilih_vendor_dan_penawaran',
                'menandatangani_kontrak'
            ]);
        });
    }
};
