<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SacoCheioInfo extends Model
{
    use HasFactory;

    protected $table = 'sacocheio_info';
    protected $fillable = [
        'channel_name'
    ];
}
