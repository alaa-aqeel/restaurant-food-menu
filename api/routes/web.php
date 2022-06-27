<?php

use App\Http\Controllers\API\v1\AuthController;
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

Route::prefix("auth")
    ->name("auth.")
    ->group(function(){

        Route::get("/login", fn() => view("auth.login"))
            ->name("login.view");
        
        Route::post('/login', [AuthController::class, "login"])
            ->name("login.post");
    });


    

