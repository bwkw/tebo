<?php

use App\Http\Controllers\BibliographyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'books'], function() {
    Route::get('/', [BibliographyController::class, 'fetchBibliographies']);
    Route::post('/', [BibliographyController::class, 'createBook']);
    Route::get('/{bookId}', [BibliographyController::class, 'fetchBibliography']);
});
