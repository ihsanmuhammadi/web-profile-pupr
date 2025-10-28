<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DataProgram extends Model
{
    use SoftDeletes;

    protected $table = 'data_programs';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'judul',
        'sub_judul',
        'deskripsi',
        'waktu_pelaksanaan',
        'tahun_anggaran',
        'lokasi',
        'status_proyek',
        'dokumentasi',
        'kategori_id',
    ];

    protected $casts = [
        'dokumentasi' => 'array',
        'waktu_pelaksanaan' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
