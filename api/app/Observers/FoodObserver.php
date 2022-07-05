<?php

namespace App\Observers;

use App\Models\Food;
use Illuminate\Support\Facades\Cache;

class FoodObserver
{

    private function forgetCache(Food $food) 
    {
        Cache::forget("food_{$food->category->menu->slug}");
        Cache::forget("food_{$food->category->menu->slug}{$food->category->id}");
    }

    /**
     * Handle the Food "created" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function created(Food $food)
    {
        $this->forgetCache($food);
    }

    /**
     * Handle the Food "updated" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function updated(Food $food)
    {
        $this->forgetCache($food);

    }

    /**
     * Handle the Food "deleted" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function deleted(Food $food)
    {
        $this->forgetCache($food);

    }

    /**
     * Handle the Food "restored" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function restored(Food $food)
    {
        $this->forgetCache($food);

    }

    /**
     * Handle the Food "force deleted" event.
     *
     * @param  \App\Models\Food  $food
     * @return void
     */
    public function forceDeleted(Food $food)
    {
        $this->forgetCache($food);
    }
}
