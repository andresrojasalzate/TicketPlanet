<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageVersion extends Model
{
    use HasFactory;

    protected $fillable  =[
        'size',
        'path',
        'image_id',
    ];
}
