<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'app_departemen';
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
        'departemen',
        'lokasi',
    ];

    public function subDepartemen()
    {
        return $this->hasMany(Departemen::class, 'parent_id', 'id');
    }

    public function scopedepartemen($query, $value = NULL)
    {
        $query->where('parent_id', $value);
    }

    public function scopeId($query, $value)
    {
        if ($value) {
            $query->where('id', '=', $value);
        }
    }

    public function scopepencarian($query, $value)
    {
        if ($value) {
            $query->where('departemen', 'like', '%' . $value . '%');
        }
    }
}
