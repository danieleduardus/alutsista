<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->boolean('menu_master_data')->default(0)->after('menu_kontrak');
        });
    }

    public function down()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->dropColumn('menu_master_data');
        });
    }
};
