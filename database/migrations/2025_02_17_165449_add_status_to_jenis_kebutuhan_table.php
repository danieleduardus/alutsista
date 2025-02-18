<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('jenis_kebutuhan', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('jenis'); // Menambahkan kolom status
        });
    }

    public function down()
    {
        Schema::table('jenis_kebutuhan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

