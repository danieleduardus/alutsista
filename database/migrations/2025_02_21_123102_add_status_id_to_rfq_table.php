<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rfq', function (Blueprint $table) {
            $table->foreignId('status_id')->after('catatan_pengiriman')->nullable()->constrained('status_rfq')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('rfq', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};
