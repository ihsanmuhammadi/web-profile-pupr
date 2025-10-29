<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function dataProgram()
    {
        return $this->belongsTo(DataProgram::class, 'data_program_id');
    }
}
