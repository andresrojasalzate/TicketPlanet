<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder; 

class Session extends Model
{
    use HasFactory;

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function scopeSessionState (Builder $query): Builder
    {
        return $query->where('open', true);
    }


    protected $fillable = [
      'date',
      'time',
      'maxCapacity',
      'ticketsSold',
      'event_id',
      'open'
    ];
}
