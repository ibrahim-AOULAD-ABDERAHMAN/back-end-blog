<?php

use App\Http\Controllers\BlogController;
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

});



//  Return JSON Messages : errors Or forbidden ...
Route::group(['middleware'=> ['force_json_sanctum']], function (){

    Route::get('/blogs',            [BlogController::class, 'index'])->name('blogs-index');
    Route::get('/blog/{id}',        [BlogController::class, 'show'])->name('blogs-show');
    Route::post('/blogs',           [BlogController::class, 'store'])->name('blogs-store');
    Route::put('/blogs/{id}',       [BlogController::class, 'update'])->name('blogs-put');
    Route::delete('/blogs/{id}',    [BlogController::class, 'delete'])->name('blogs-delete');

});
