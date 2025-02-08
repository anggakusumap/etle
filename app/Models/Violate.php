<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violate extends Model
{
    use HasFactory;

    protected $table = 'tb_data_pelanggaran_kendaraan';
    protected $primaryKey = 'no_referensi';
    protected $keyType = 'string';

    protected $fillable = [
        'no', 'no_referensi', 'lokasi', 'plat', 'warna_plat', 'warna_kendaraan', 'tipe_kendaraan',
        'tanggal_pelanggaran', 'jenis_pelanggaran', 'status'
    ];
}
