<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
    * Busca eventos en la base de datos que coincidan con el texto de entrada y, opcionalmente, con una categoría específica.
    *
    * @param string $inputText Texto de búsqueda para el nombre del evento o el sitio.
    * @param string|null $category Categoría opcional para filtrar los eventos.
    *
    * @return Event[] Colección de eventos que coinciden con los criterios de búsqueda.
    */
    public static function eventosBuscados(string $inputText, string $category = null){
        $eventos = Event::where(function($query) use ($inputText) {
            $query->whereRaw('lower(unaccent(name)) LIKE unaccent(?)', [trim(strtolower($inputText)).'%'])
                ->orWhereRaw('lower(unaccent(site)) LIKE unaccent(?)', [trim(strtolower($inputText)).'%']);
        });
        
        if(isset($category)){
            
            $eventos = $eventos->where('category', $category);
        }

        $eventos = $eventos->with('sessions')->paginate(env('PAGINATION_LIMIT'));
        return $eventos;
    }

}
