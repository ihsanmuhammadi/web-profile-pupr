<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'description', 'tujuan', 'contoh_program_1', 'contoh_program_2', 'contoh_program_3'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function dataPrograms()
    {
        return $this->hasMany(DataProgram::class, 'kategori_id');
    }

}
