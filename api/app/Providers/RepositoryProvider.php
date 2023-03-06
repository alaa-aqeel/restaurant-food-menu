<?php

namespace App\Providers;

use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\FoodRepositoryInterface;
use App\Interfaces\MenuRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FoodRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public $bindings = [
        BaseRepositoryInterface::class => BaseRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        MenuRepositoryInterface::class => MenuRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        FoodRepositoryInterface::class => FoodRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
