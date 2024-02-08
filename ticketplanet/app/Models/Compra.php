<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'date',
        'time',
        'ticket_name',
        'ticket_quantity',
        'session_id',
        'ticket_id',
    ];

    // Relación con la sesión de compra
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    // Relación con el ticket de compra
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
