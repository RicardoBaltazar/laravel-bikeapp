<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RentedProductController;
use App\Http\Controllers\Services\StatisticController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('products', [ProductController::class, 'index']);
Route::get('rented_products', [RentedProductController::class, 'index']);
Route::post('rented_product', [RentedProductController::class, 'store']);
Route::delete('rented_product/{id}', [RentedProductController::class, 'destroy']);
Route::post('devolution', [RentedProductController::class, 'devolution']);
Route::get('devolutions-list', [RentedProductController::class, 'devolutionsList']);

Route::get('statistic-rented-products', [StatisticController::class, 'statisticRentedProducts']);
