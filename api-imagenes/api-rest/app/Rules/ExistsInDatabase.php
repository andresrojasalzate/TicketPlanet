<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class ExistsInDatabase implements Rule
{


    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        return Image::where('hash', $value)->exists();
    }

    public function message()
    {
        return 'El registro no existe en la base de datos.';
    }
}