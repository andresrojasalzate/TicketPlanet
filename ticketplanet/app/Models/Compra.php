<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'emailPurchaser',
        'namePurchaser',
        'dniPurchaser',
        'phonePurchaser',
        'session_id',
        'pdfTickets',
    ];

    // Relación con la sesión de compra
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function assistants(): HasMany
    {
        return $this->hasMany(Assistant::class);
    }

}
