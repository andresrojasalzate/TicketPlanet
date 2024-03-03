<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'quantity',
      'price',
      'sold_tickets',
      'nominal',
      'session_id'
    ];
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function assistants(): HasMany
    {
        return $this->hasMany(Assistant::class);
    }
}
