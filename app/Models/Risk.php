<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;

    protected $table = 'tb_analisis_risiko_per_plat';
    protected $primaryKey = 'risk_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'risk_code', 'plat', 'baru_hp', 'baru_helm', 'baru_sabuk',
        'blokir_hp', 'blokir_helm', 'blokir_sabuk', 'terbayar_hp', 'terbayar_helm',
        'terbayar_sabuk', 'denda_total', 'total_pelanggaran', 'skor_risiko',
        'likelihood', 'impact', 'risk_level'
    ];
}
