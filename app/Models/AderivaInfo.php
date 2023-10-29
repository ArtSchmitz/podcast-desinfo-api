<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AderivaInfo extends Model
{
    use HasFactory;
    protected $table = 'aderiva_info';
    protected $fillable = [
        'channel_name'
    ];
}
