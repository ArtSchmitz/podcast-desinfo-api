<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesinfoInfo extends Model
{
    use HasFactory;
    protected $table = 'channel_info';
    protected $fillable = [
        'channel_name'
    ];
}
