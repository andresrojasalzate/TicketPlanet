<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable  =[
        'hash'
    ];

    public function imageVesrions(): HasMany
    {
        return $this->hasMany(ImageVersion::class);
    }

}
