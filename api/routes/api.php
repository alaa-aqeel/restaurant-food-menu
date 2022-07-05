<?php

use App\Http\Controllers\API\v1\AccountController;
use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\FoodController;
use App\Http\Controllers\API\v1\MenuController;
use App\Http\Controllers\API\v1\RestaurantController;
use App\Http\Controllers\Auth\LoginController;
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


Route::name("public.")->group(function(){
    Route::post("login", [LoginController::class, "login"])->name('login');
    Route::get("restaurant/{slug}", [RestaurantController::class, "index"])->name("restaurant.index");
});

Route::middleware('auth:sanctum')
    ->name("app.")
    ->group(function(){

        Route::controller(AccountController::class)
            ->name("account.")
            ->prefix("account")
            ->group(/*  */
            function(){
                Route::controller(AccountController::class)
                    ->group(function(){
                        Route::get("", "getAccount");
                        Route::put("update", "updateAccount");
                    });
            });

        Route::controller(MenuController::class)
            ->prefix("menu")
            ->name("menu.")
            ->group(function(){
                Route::get("", "getMenu")->name("get");
                Route::post("update", "updateMenu")->name("update");
                

                Route::middleware("user.check_menu")
                    ->group(function(){
                        Route::apiResource("/category", CategoryController::class);
                        Route::apiResource("category.food", FoodController::class);
                    });
            });   
    });
    // });

