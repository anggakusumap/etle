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
        Schema::create('tb_analisis_risiko_per_plat', function (Blueprint $table) {
            $table->string('risk_code', 10)->primary();
            $table->integer('plat');
            $table->integer('baru_hp');
            $table->integer('baru_helm');
            $table->integer('baru_sabuk');
            $table->integer('blokir_hp');
            $table->integer('blokir_helm');
            $table->integer('blokir_sabuk');
            $table->integer('terbayar_hp');
            $table->integer('terbayar_helm');
            $table->integer('terbayar_sabuk');
            $table->decimal('denda_total', 15, 2);
            $table->integer('total_pelanggaran');
            $table->decimal('skor_risiko', 15, 2);
            $table->integer('likelihood');
            $table->integer('impact');
            $table->string('risk_level', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_risiko_per_plat');
    }
};
