<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usulan_anggaran', function (Blueprint $table) {
            $table->id(); // Auto increment Primary Key (int(10))
            $table->string('nomor', 20)->unique(); // varchar(20) Unique
            $table->decimal('jumlah', 10, 2); // decimal(10,2)
            $table->decimal('realisasi', 10, 2); // decimal(10,2)
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('usulan_anggaran');
    }
};
