<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function eventsLimited(): HasMany
    {
        return $this->hasMany(Event::class)->take(6);
    }
    
}
