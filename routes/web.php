<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleManController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOptionController;
use App\Http\Controllers\ItemOptionValueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SystemOptionController;
use App\Http\Controllers\PaymentController;
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

    Route::get('/',[HomeController::class, 'index'])->name('dashboard');

    Route::resources([
        'users' => UserController::class,
        'sales-men' => SaleManController::class,
        'stores' => StoreController::class,
        'clients' => ClientController::class,
        'suppliers' => SupplierController::class,
        'categories' => CategoryController::class,
        'brands' => BrandController::class,
        'options' => OptionController::class,
        'items' => ItemController::class,
        'item-options' => ItemOptionController::class,
        'item-option-values'=>ItemOptionValueController::class,
        'bills' => BillController::class,
        'bill-details' => BillDetailController::class,
        'payments' => PaymentController::class,
    ]);
    Route::resource('system-options', systemOptionController::class)->only([
        'index', 'edit','update'
    ]);

    Route::get('stores-all',[StoreController::class, 'all'])->name('stores.all');

    Route::post('bills/save/{id}',[BillController::class, 'save'])->name('bills.save');
    Route::get('bills/print/{id}',[BillController::class, 'print'])->name('bills.print');

    Route::get('payments/print/{id}',[PaymentController::class, 'print'])->name('payments.print');

    Route::post('item-option-values/final-submit/{id}',[ItemOptionValueController::class, 'finalSubmit'])->name('item-options.final-submit');


    Route::get('sales-men/{id}/report',[SaleManController::class, 'report'])->name('sales-men.report');

    Route::get('sales-men/{id}/collect',[SaleManController::class, 'collect'])->name('sales-men.collect');

    Route::get('clients/{id}/report',[ClientController::class, 'report'])->name('clients.report');

    Route::get('suppliers/{id}/report',[SupplierController::class, 'report'])->name('suppliers.report');

});

require __DIR__.'/auth.php';
