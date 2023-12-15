<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;


Route::get('/', function () {
    return view('/links/home');
});


Route::get('/links/home', [LinksController::class, 'home'])->name('home');
Route::get('/links/aboutus', [LinksController::class, 'aboutUs'])->name('links.aboutus');
Route::get('/links/legalnotice', [LinksController::class, 'legalNotice'])->name('links.legalnotice');