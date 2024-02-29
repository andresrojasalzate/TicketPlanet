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
use App\Http\Controllers\CompraController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/events', [EventController::class, 'searchGet'])->name('events.index');
Route::post('/events', [EventController::class, 'search'])->name('events.search');
Route::post('/events/category', [HomeController::class, 'category'])->name('events.category');
Route::get('/events/category', [HomeController::class, 'categoryGet'])->name('events.category');
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



Route::get('/links/comprarEntradas', [LinksController::class, 'comprarEntradas'])->name('links.comprarEntradas');

Route::post('/links/crearEvento/save', [LinksController::class, 'store'])->name('links.store');

Route::post('/links/comprarEntradas/save', [LinksController::class, 'storeComprarEntradas'])->name('links.storeComprarEntradas');


Route::get('/links/editarEvento/{id}', [LinksController::class, 'editarEvento'])->name('links.editarEvento');


/*MOSTRAR EVENTOS*/
Route::get('/events/{id}', [ShowEventController::class, 'mostrarEvento'])->name('events.mostrar');


Route::get('/links/administrarEvents', [LinksController::class, 'administrarEvento'])->name('links.administrarEvents');


/*VALORACIÓN*/
Route::get('/valoracion/formValoracion/{eventoId}', [ValoracionController::class, 'mostrarFormulario'])->name('valoracion.form');

Route::post('/guardar-valoracion', [ValoracionController::class, 'guardarValoracion'])->name('guardarValoracion');


Route::post('/enviar-correo-valoracion', [ValoracionController::class, 'enviarCorreoValoracion'])->name('enviar.correo.valoracion');


/*SESIONES*/
Route::get('/sessions-promotor', [SessionController::class, 'sessionsPromotor'])->name('sessions.promotor');
Route::put('/sessions-promotor/cambiarEstadoSesion', [SessionController::class, 'cambiarEstadoSesion'])->name('sessions.promotor.cambiarEstado');

Route::get('/links/sessionEvents', [LinksController::class, 'sessionEvents'])->name('links.sessionEvents');

Route::get('/links/multiplesSesiones/{id}', [LinksController::class, 'multiplesSesiones'])->name('links.multiplesSesiones');

Route::post('/links/crearMultiplesSesiones/{id}', [LinksController::class, 'crearMultiplesSesiones'])->name('links.crearMultiplesSesiones');

Route::get('/links/comprarEntradasSesion', [LinksController::class, 'comprarEntradasSesion'])->name('links.comprarEntradasSesion');

Route::post('/links/comprarEntradasSesion/save', [LinksController::class, 'storeComprarEntradasSesion'])->name('links.storeComprarEntradasSesion');

Route::get('/links/sesionesEventoMostrar/{id}', [LinksController::class, 'sesionesEventoMostrar'])->name('links.sesionesEventoMostrar');

Route::get('/links/sesionesEventoEditar/{id}', [LinksController::class, 'sesionesEventoEditar'])->name('links.sesionesEventoEditar');

Route::post('/links/storeEditarSesionesPromotor/{id}', [LinksController::class, 'storeEditarSesionesPromotor'])->name('links.storeEditarSesionesPromotor');

/*Compra */

Route::get('/entradas/pdf', [CompraController::class, 'generarPdfEntradas'])->name('entradas.pdf');
Route::get('/entradas/pdf/descargar/{pdf}', [CompraController::class, 'descargarEntradas'])->name('entradas.descargar.pdf');
Route::get('/mostrar-compra/{evento_id}', [CompraController::class, 'mostrarCompra'])->name('mostrar.compra');
Route::post('/compra', [CompraController::class, 'almacenarCompra'])->name('compra.almacenar');

Route::get('/compraExito',[CompraController::class, 'entradaComprada'])->name('entradaComprada');
Route::get('/viewCompraExito',[CompraController::class, 'entradaCompradaView'])->name('compra.compraExito');
Route::get('/viewCompraFallido',[CompraController::class, 'entradaCompradaViewFallido'])->name('entradaCompradaViewFallido');
Route::post('/datosRedsys',[CompraController::class, 'datosRedsys'])->name('datosRedsys');
Route::post('/paginaRedsys',[CompraController::class, 'paginaRedsys'])->name('paginaRedsys');
 
