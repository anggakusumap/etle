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
             // String-based primary key
            $table->integer('plat')->primary();
            $table->integer('baru_hp')->default(0);
            $table->integer('baru_helm')->default(0);
            $table->integer('baru_sabuk')->default(0);
            $table->integer('blokir_hp')->default(0);
            $table->integer('blokir_helm')->default(0);
            $table->integer('blokir_sabuk')->default(0);
            $table->integer('terbayar_hp')->default(0);
            $table->integer('terbayar_helm')->default(0);
            $table->integer('terbayar_sabuk')->default(0);
            $table->decimal('denda_total', 15, 2)->default(0.00);
            $table->integer('total_pelanggaran')->default(0);
            $table->decimal('skor_risiko', 15, 2)->default(0.00);
            $table->integer('likelihood')->default(0);
            $table->integer('impact')->default(0);
            $table->string('risk_level', 10)->nullable();
            $table->string('risk_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_analisis_risiko_per_plat');
    }
};
