<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->id(); // Primary Key Auto Increment
            $table->string('hak_akses', 100)->unique(); // Nama Hak Akses
            $table->boolean('status')->default(1); // 1 = Aktif, 0 = Non-Aktif
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('hak_akses');
    }
};
