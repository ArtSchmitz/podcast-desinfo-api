<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aderiva extends Model
{
    use HasFactory;

    protected $table = 'aderiva';
    protected $fillable = ['title', 'description', 'video_url'];
}
