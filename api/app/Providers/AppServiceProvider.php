<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Menu;
use App\Observers\CategoryObserver;
use App\Observers\FoodObserver;
use App\Observers\MenuObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Menu::observe(MenuObserver::class);
        Food::observe(FoodObserver::class);
    }
}
