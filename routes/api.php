<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CollectionController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\CheckToken;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/users/create', [UserController::class, 'singUp']);
Route::post('/users/login', [UserController::class, 'logIn']);
Route::post('/users/admin/{id}', [UserController::class, 'makeAdmin']);
Route::post('/users/forgotPassword', [UserController::class, 'forgotPassword']);


Route::post('/cards/create/{token}', [CardController::class, 'createCard'])->middleware(EnsureTokenIsValid::class);
Route::post('/cards/update/{id}/{token}', [CardController::class, 'updateCard'])->middleware(EnsureTokenIsValid::class);

Route::get('/cards/buy', [CardController::class, 'buyCard']);

Route::get('/sales/find/{token}', [SaleController::class, 'findCard'])->middleware(CheckToken::class);
Route::post('/sales/sell/{id}/{token}', [SaleController::class, 'createSale'])->middleware(CheckToken::class);

Route::post('/collections/create/{token}', [CollectionController::class, 'createCollection'])->middleware(EnsureTokenIsValid::class);
Route::post('/collections/update/{id}/{token}', [CollectionController::class, 'updateCollection'])->middleware(EnsureTokenIsValid::class);

