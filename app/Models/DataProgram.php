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
        'waktu_mulai',
        'waktu_selesai',
        'tahun_anggaran',
        'kecamatan',
        'lokasi',
        'status_proyek',
        'dokumentasi',
        'tenaga_kerja_1',
        'posisi_1',
        'tenaga_kerja_2',
        'posisi_2',
        'tenaga_kerja_3',
        'posisi_3',
        'tenaga_kerja_4',
        'posisi_4',
        'tenaga_kerja_5',
        'posisi_5',
        'kategori_id',
    ];

    protected $casts = [
        'waktu_mulai' => 'date',
        'waktu_selesai' => 'date',
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

    public function work()
    {
        return $this->hasMany(Work::class, 'data_program_id');
    }
}
