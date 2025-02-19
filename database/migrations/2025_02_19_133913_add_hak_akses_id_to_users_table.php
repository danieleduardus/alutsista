<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('hak_akses_id')->nullable()->after('email');
            $table->foreign('hak_akses_id')->references('id')->on('hak_akses')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['hak_akses_id']);
            $table->dropColumn('hak_akses_id');
        });
    }
};
