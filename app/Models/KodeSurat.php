<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KodeSurat extends Model
{
    use HasFactory;

    protected $table = 'app_kode_surat';
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
        'parent_id',
        'kode',
        'keterangan',
    ];

    public function turunanKode()
    {
        return $this->hasMany(KodeSurat::class, 'parent_id', 'id');
    }

    public function scopepencarian($query, $value)
    {
        if ($value) {
            $query->where('kode', 'like', '%' . $value . '%')
                ->orWhere('keterangan', 'like', '%' . $value . '%');
        }
    }
}
