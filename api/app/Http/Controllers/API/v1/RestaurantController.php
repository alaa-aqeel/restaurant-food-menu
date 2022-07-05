<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FoodResource;
use App\Http\Resources\MenuResource;
use App\Interfaces\FoodRepositoryInterface;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{

    /**
     * @var FoodRepositoryInterface
     */
    private FoodRepositoryInterface $food; 

    /**
     * Create a new AuthController instance.
     *
     * @param FoodRepositoryInterface $foodRepository
     * @return void
     */
    function __construct(FoodRepositoryInterface $foodRepository)
    {
        $this->food = $foodRepository;
    }

    
    public function index(Request $request, $slug) 
    {   
        
        // sleep(5);
        if (empty($slug) || is_null($slug)) {
            return response()->json([
                'message' => 'Invalid slug',
                'status' => 'error'
            ], 400);
        }

        
        $categoyId = $request->get("category", '');

        // Cache::forget("menu_{$slug}");
        $menu = Cache::rememberForever("menu_{$slug}", fn()=> Menu::where("slug", $slug)->first());

        $categories = Cache::rememberForever("categories_{$slug}", fn()=> $menu->categories()->get());

        $food = Cache::rememberForever("food_{$slug}{$categoyId}", function() use($categoyId,  $menu){
            return $this->food->filter([
                'category' => $categoyId,
                'menu' => $menu->id,
            ])->get();
        });
        
        $resource = FoodResource::collection($food);
        $resource->additional([
            'menu' => $menu,
            'categories' => CategoryResource::collection($categories),
        ]);

        return $resource;
    }

}
