<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
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

Route::middleware("guest")
    ->name("auth.")
    ->group(function(){

        Route::get("", fn() => view("auth.login"))
            ->name("login.view");
        
        Route::post('/login', [LoginController::class, "login"])
            ->name("login.post");
    });


Route::middleware("auth:web")
    ->group(function(){

        Route::post("/logout", function(){
                auth()->logout();
                return redirect(route("auth.login.view"));
            })->name("auth.logout");

        Route::get("/dashboard", fn() => view("dashboard"))
            ->name("dashboard");

        Route::resource("users", UserController::class);
        
    });


    

