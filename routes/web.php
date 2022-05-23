<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\ObjetoController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        // Route::get('objetos', 'ObjetoController@index')->name('objetos');
        Route::get('objetos', [ObjetoController::class, 'index'])->name('objetos');
        Route::get('itemsAulas/{id}', [ObjetoController::class, 'buscaItemsAula'])->name('itemsAulas');
    });

    URL::forceScheme('https');
