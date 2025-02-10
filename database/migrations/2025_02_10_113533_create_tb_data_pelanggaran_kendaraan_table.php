<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_data_pelanggaran_kendaraan', function (Blueprint $table) {
            $table->bigIncrements('no'); // Auto-increment primary key
            $table->string('no_referensi')->unique(); // Unique string-based primary key
            $table->string('lokasi');
            $table->integer('plat');
            $table->string('warna_plat');
            $table->string('warna_kendaraan');
            $table->string('tipe_kendaraan');
            $table->timestamp('tanggal_pelanggaran');
            $table->string('jenis_pelanggaran');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_pelanggaran_kendaraan');
    }
};
