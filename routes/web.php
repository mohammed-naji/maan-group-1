<?php

use App\Http\Controllers\HomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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
    // return Product::all();
    $prod = Product::all();
    return view('welcome', compact('prod'));
});

Route::get('export-products', [HomeController::class, 'export']);

Route::post('import', [HomeController::class, 'import'])->name('import');


