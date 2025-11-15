<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Application extends Model
{
    use SoftDeletes;

    protected $table = 'applications';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'email',
        'lokasi',
        'pendidikan',
        'jurusan',
        'cv',
        'portofolio',
        'work_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
