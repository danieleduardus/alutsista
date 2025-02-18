<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('prioritas_kebutuhan', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('prioritas'); // Tambahkan kolom status
        });
    }

    public function down()
    {
        Schema::table('prioritas_kebutuhan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
