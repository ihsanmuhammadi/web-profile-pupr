<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Work extends Model
{
    use SoftDeletes;

    protected $table = 'works';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'posisi',
        'jenis',
        'tipe',
        'lokasi',
        'gaji',
        'deskripsi',
        'kualifikasi',
        'data_program_id',
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
