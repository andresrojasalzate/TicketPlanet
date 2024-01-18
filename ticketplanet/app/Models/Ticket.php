<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'quantity',
      'price',
      'nominal',
      'session_id'
    ];
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
