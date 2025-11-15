<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use SoftDeletes;

    protected $table = 'complaints';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['nama', 'email', 'pesan'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
