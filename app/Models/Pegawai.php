<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'app_pegawai';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'nip',
        'nama_pegawai',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'golongan',
        'jabatan',
        'jabatan_tugas_tambahan',
        'unit_kerja_id',
        'unit_kerja_string',
        'departemen_id',
        'departemen_string',
        'hp',
        'email',
        'alamat',
        'kategori_pegawai'
    ];

    public function scopepencarian($query, $value)
    {
        if ($value) {
            $query->where('nip', 'like', '%' . $value . '%')
                ->orWhere('nama_pegawai', 'like', '%' . $value . '%');
        }
    }

    public function scopegolongan($query, $value)
    {
        if ($value) {
            $query->where('golongan', '=', $value);
        }
    }

    public function scopeunit_kerja($query, $value)
    {
        if ($value) {
            $query->where('unit_kerja_id', '=', $value);
        }
    }

    public function scopedepartemen($query, $value)
    {
        if ($value) {
            $query->where('departemen_id', '=', $value);
        }
    }

    public function scopekategori_pegawai($query, $value)
    {
        if ($value) {
            $query->where('kategori_pegawai', '=', $value);
        }
    }

    public function departemen()
    {
        return $this->hasOne(Departemen::class, 'id', 'departemen_id');
    }
}
