<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table = 'app_pimpinan';
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
        'nama_pimpinan',
        'nip',
        'golongan',
        'jabatan',
        'ppk',
    ];

    public function scopepencarian($query, $value)
    {
        if ($value) {
            $query->where('nama_pimpinan', 'like', '%' . $value . '%');
        }
    }
}
