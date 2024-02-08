<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Log;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(Ticket::class, Session::class);
    }

    public function valoraciones(): HasMany
    {
        return $this->hasMany(Valoracion::class);
    }

    protected $fillable = [
      'name',
      'address',
      'city',
      'name_site',
      'image',
      'description',
      'finishDate',
      'finishTime',
      'visible',
      'capacity',
      'category_id',
      'user_id'
    ];

    /**
    * Busca eventos en la base de datos que coincidan con el texto de entrada y, opcionalmente, con una categoría específica.
    *
    * @param string $inputText Texto de búsqueda para el nombre del evento o el sitio.
    * @param string|null $category Categoría opcional para filtrar los eventos.
    *
    * @return Event[] Colección de eventos que coinciden con los criterios de búsqueda.
    */
    public static function eventosBuscados(string $inputText = null, string $category = null){
        if(isset($inputText) || isset($category)){

            Log::info("Recuperamos los eventos filtrando por el texto recibido en los campos 'name, 'city' y 'name_site'");

            $eventos = Event::where(function($query) use ($inputText) {
                $query->whereRaw('lower(unaccent(name)) LIKE unaccent(?)', ['%'. trim(strtolower($inputText)).'%'])
                    ->orWhereRaw('lower(unaccent(city)) LIKE unaccent(?)', ['%'. trim(strtolower($inputText)).'%'])
                    ->orWhereRaw('lower(unaccent(name_site)) LIKE unaccent(?)', ['%'. trim(strtolower($inputText)).'%']);
            });
            
            if(isset($category)){ 

                Log::info("Filtramos los eventos por la categoria recibida");  

                $eventos = $eventos->where('category_id', $category);
            }

            Log::info("Devolvemos los eventos encontrados");   

            return $eventos->paginate(env('PAGINATION_LIMIT'));
        }else{
            
            Log::info("Devolvemos null al inputText estar vacío");  
            return null;
        }
    }

}
