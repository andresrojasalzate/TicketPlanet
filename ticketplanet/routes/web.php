<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPwdController;

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


/*RESET PASSWORD*/ 
Route::get('/forgot-password', [ForgotPwdController::class, 'showResetPwd'])->name('password.request');
Route::post('/forgot-password', [ForgotPwdController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPwdController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPwdController::class, 'reset'])->name('password.update');


Route::get('/links/homePromotors', [LinksController::class, 'homePromotors'])->name('links.homePromotors');

Route::get('/events/crearEvento', [EventController::class, 'crearEvento'])->name('events.crearEvento');
