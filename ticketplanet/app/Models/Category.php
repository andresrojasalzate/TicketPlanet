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


    /**
    * Recupera todas las categorías con sus eventos y sesiones asociadas para su visualización en la página de inicio.
    *
    * @return \Illuminate\Database\Eloquent\Collection|static[] Array de objetos de categoría con eventos y sesiones relacionadas cargadas.
    */
    public static function recuperarCategoriasHome(){

        Log::info("Recuperamos las categorias con sus eventos y sesiones");
        
        $categories = Category::with(['events' => function($query){
            $query->with('sessions');
        }])->get();

        return $categories;
    }
}
