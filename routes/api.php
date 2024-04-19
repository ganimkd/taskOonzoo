<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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


Route::get('get-products', [ApiController::class, 'getProducts'])->name('get-products');

Route::post('register-user', [ApiController::class, 'register'])->name('register');
Route::post('login-user', [ApiController::class, 'login'])->name('login');


// Public API
Route::get('endpoint-public', [ApiController::class, 'publicEndpoint'])->name('endpoint-public');
// Private API
Route::middleware('auth:api')->get('endpoint-private', [ApiController::class, 'privateEndpoint'])->name('endpoint-private');
