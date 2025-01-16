<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatNomorSurat extends Model
{
    use HasFactory;

    protected $table = 'app_riwayat_nomor_surat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor',
        'kode',
        'tahun',
        'jenis_surat',
        'keterangan',
        'surat_id',
    ];

    public function scopekode($query, $value)
    {
        if ($value) {
            $query->where('kode', '=', $value);
        }
    }
    public function scopetahun($query, $value)
    {
        if ($value) {
            $query->where('tahun', '=', $value);
        }
    }
    public function scopejenis($query, $value)
    {
        if ($value) {
            $query->where('jenis_surat', '=', $value);
        }
    }
}
