<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleManController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:web','prefix'=>'dashboard'], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resources([
        'users' => UserController::class,
        'sales-men' => SaleManController::class,
        'stores' => StoreController::class,
        'clients' => ClientController::class,
    ]);
});

require __DIR__.'/auth.php';
