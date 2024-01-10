<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\LoginController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::post('/events', [EventController::class, 'search'])->name('events.search');
    
/*HEADER LINKS*/
Route::get('/links/aboutus', [LinksController::class, 'aboutUs'])->name('links.aboutus');
Route::get('/links/legalnotice', [LinksController::class, 'legalNotice'])->name('links.legalnotice');

/*LOGIN*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.validate');
Route::get('/logout',[LoginController::class, 'logout'])->name('auth.logout');

Route::get('/links/homePromotors', [LinksController::class, 'homePromotors'])->name('links.homePromotors');

Route::get('/events/crearEvento', [EventController::class, 'crearEvento'])->name('events.crearEvento');
