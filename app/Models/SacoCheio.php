<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SacoCheio extends Model
{
    use HasFactory;

    protected $table = 'sacocheio';
    protected $fillable = [
        'title',
        'description',
        'video_url'
    ];
}
