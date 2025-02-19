<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->unsignedBigInteger('usulan_anggaran_id')->nullable()->after('prioritas_id');
            $table->foreign('usulan_anggaran_id')->references('id')->on('usulan_anggaran')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('rencana_kebutuhan', function (Blueprint $table) {
            $table->dropForeign(['usulan_anggaran_id']);
            $table->dropColumn('usulan_anggaran_id');
        });
    }
};
