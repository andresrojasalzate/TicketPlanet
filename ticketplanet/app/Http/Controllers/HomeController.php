<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class HomeController extends Controller
{
    public function home(){
        
        /*$categories = Category::recuperarCategoriasHome();

        return $categories;*/
        return view('events.home', ['categories'=> Category::recuperarCategoriasHome()]);
       
    }
}
