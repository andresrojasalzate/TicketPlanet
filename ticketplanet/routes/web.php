<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LinksController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('events', [EventController::class, 'index'])->name('events.index');
    
Route::get('/links/home', [LinksController::class, 'home'])->name('links.home');
Route::get('/links/aboutus', [LinksController::class, 'aboutUs'])->name('links.aboutus');
Route::get('/links/legalnotice', [LinksController::class, 'legalNotice'])->name('links.legalnotice');
