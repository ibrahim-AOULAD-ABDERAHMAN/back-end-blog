<?php

use App\Http\Controllers\AuthController;
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

 // Login
 Route::post('/login', [AuthController::class, 'login']);

//  Return JSON Messages : errors Or forbidden ...
Route::group(['middleware'=> ['force_json_sanctum']], function () {

    //  Locked routes
    Route::group(['middleware'=> ['auth:sanctum']], function () {

         // Logout
        Route::post('/logout', [AuthController::class, 'logout']);

        // Blogs
        Route::post('/blogs',           [BlogController::class, 'store'])->name('blogs-store');
        Route::put('/blogs/{id}',       [BlogController::class, 'update'])->name('blogs-update');
        Route::delete('/blogs/{id}',    [BlogController::class, 'delete'])->name('blogs-delete');

    });

     // Free routes ======================================
     // Blogs
     Route::get('/blogs',            [BlogController::class, 'index'])->name('blogs-index');
     Route::get('/blog/{id}',        [BlogController::class, 'show'])->name('blogs-show');
});
