<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPwdController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ResetPwdController;
use App\Http\Controllers\ShowEventController;
use App\Http\Controllers\ValoracionController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/events', [EventController::class, 'searchGet'])->name('events.index');
Route::post('/events', [EventController::class, 'search'])->name('events.search');
Route::post('/events/category', [EventController::class, 'category'])->name('events.category');
Route::get('/events/category', [EventController::class, 'categoryGet'])->name('events.category');
/*HEADER LINKS*/
Route::get('/links/aboutus', [LinksController::class, 'aboutUs'])->name('links.aboutus');
Route::get('/links/legalnotice', [LinksController::class, 'legalNotice'])->name('links.legalnotice');

/*LOGIN*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.validate');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');


/*RESET PASSWORD*/
Route::get('/forgot-password', [ForgotPwdController::class, 'showResetPwd'])->name('password.request');
Route::post('/forgot-password', [ForgotPwdController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPwdController::class, 'showResetForm'])->name('password.reset');

Route::get('/auth/resetPwd/{token}', [ResetPwdController::class, 'showResetForm'])->name('auth.resetPwd');
Route::post('/reset-password', [ResetPwdController::class, 'reset'])->name('password.update');

Route::get('/auth/expired', [ResetPwdController::class, 'showResetForm'])->name('auth.expired');


Route::get('/links/homePromotors', [LinksController::class, 'homePromotors'])->name('links.homePromotors');

/*CREAR EVENTO*/
Route::get('/links/crearEvento', [LinksController::class, 'crearEvento'])->name('links.crearEvento');
Route::post('/links/guardarEvento', [LinksController::class, 'guardarEvento'])->name('links.guardarEvento');


Route::get('/sessions-promotor', [SessionController::class, 'sessionsPromotor'])->name('sessions.promotor');
Route::get('/links/comprarEntradas', [LinksController::class, 'comprarEntradas'])->name('links.comprarEntradas');

Route::post('/links/crearEvento/save', [LinksController::class, 'store'])->name('links.store');

Route::post('/links/comprarEntradas/save', [LinksController::class, 'storeComprarEntradas'])->name('links.storeComprarEntradas');

/*MOSTRAR EVENTOS*/
Route::get('/events/{id}', [ShowEventController::class, 'mostrarEvento'])->name('events.mostrar');


Route::get('/links/administrarEvents', [LinksController::class, 'administrarEvento'])->name('links.administrarEvents');


/*VALORACIÓN*/
Route::get('/valoracion/formValoracion', [ValoracionController::class, 'mostrarFormulario'])->name('valoracion.form');

Route::post('/guardar-valoracion', [ValoracionController::class, 'guardarValoracion'])->name('guardarValoracion');


Route::post('/enviar-correo-valoracion', [ValoracionController::class, 'enviarCorreoValoracion'])->name('enviar.correo.valoracion');
