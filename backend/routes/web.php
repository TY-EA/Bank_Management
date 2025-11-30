<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Routes pour les clients (CRUD complet)
Route::resource('clients', App\Http\Controllers\ClientController::class);

// Routes pour les comptes (CRUD complet)
Route::resource('comptes', App\Http\Controllers\CompteController::class);

// Routes pour les virements
use App\Http\Controllers\VirementController;

Route::resource('virements', VirementController::class);

Route::get('/', function (){
    return redirect()->route('login');
});

// Formulaire de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Route pour soumettre le formulaire (POST)
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route pour la déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
