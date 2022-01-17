<?php

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
Route::prefix("v1")->name("api.v1.")->namespace("App\Http\Controllers\api")->group(function(){



    Route::get('/email/verify',"VerificationController@sendVerificationEmail")->middleware('auth:sanctum')->name('verification.notice');

    Route::post("/login","ApiAuthController@login");

    Route::post("/register","ApiAuthController@store")->name("register");

    Route::get('/email/verify/{id}/{hash}',"VerificationController@verify")->middleware(['auth', 'signed'])->name('verification.verify');

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::get("/delete","ApiAuthController@deleteToken")->name("delete_token");
        Route::get("/user","ApiAuthController@getUser")->name("getUser");
        Route::apiResource('/categories',"CategoryController" );
        Route::apiResource('/home',"HommeController" );
        Route::apiResource("/products","ProductController");
    });
});
