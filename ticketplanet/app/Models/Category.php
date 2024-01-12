<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public static function recuperarCategoriasHome(){

        /*$idsCategoria = Category::pluck('id');
        $categories = [];
        for ($i = 0; $i < count($idsCategoria); $i++) {
            $categoria = Category::with(['events' => function($querry){
                $querry->take(5)
                        ->with(['sessions' => function ($querySessions){
                            $querySessions->take(1);
                }]);
            }])->
            find($idsCategoria[$i]);

            array_push($categories, $categoria);
        }

        return $categories;*/

        $categories = Category::with(['events' => function($query){
            $query->with('sessions');
        }])->get();

        return $categories;
    }
}
