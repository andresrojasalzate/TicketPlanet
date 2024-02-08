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
    
    public function scopeWithEvents($query)
    {
        $subquery = Event::whereColumn('events.category_id', 'categories.id')
        ->limit(5);

        $query->addSelect([
            'events' => $subquery,
        ]);
    }

    /**
    * Recupera todas las categorías con sus eventos y sesiones asociadas para su visualización en la página de inicio.
    *
    * @return \Illuminate\Database\Eloquent\Collection|static[] Array de objetos de categoría con eventos y sesiones relacionadas cargadas.
    */
    public static function recuperarCategoriasHome(){

        Log::info("Recuperamos las categorias con sus eventos y sesiones");

        //  $categories = Category::with(['events' => function($query){
        //      $query->with('sessions');
        // }])->get();

        //  return $categories;

        $categorias = Category::query()->with('events')->withEvents()->get();

        dd($categorias);
    }
}
