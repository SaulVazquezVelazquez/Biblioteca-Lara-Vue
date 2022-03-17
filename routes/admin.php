<?php


use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\GesbookController;
use App\Http\Controllers\GesprestamoController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LibroprestadoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Auth::routes(['verify' => true]);

// Route::resource('/home', AdminHomeController::class)->only('index')->middleware('verified');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('gesbook', GesbookController::class)->only('index')->names('admin.gesbook');

Route::apiResource('/libro', LibroController::class);

Route::resource('gesprestamo', GesprestamoController::class)->only('index')->names('admin.gesprestamo');

Route::apiResource('/prestamo', PrestamoController::class);

Route::resource('user', UserController::class)->names('admin.user');

Route::resource('roles', RolesController::class)->names('admin.roles')->except('show');


Route::apiResource('/libroprestado',LibroprestadoController::class)->only('index');