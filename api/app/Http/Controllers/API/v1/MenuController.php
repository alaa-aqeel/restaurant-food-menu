<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Http\Resources\MenuResource;
use App\Interfaces\MenuRepositoryInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
        /**
     * @var MenuRepositoryInterface
     */
    private MenuRepositoryInterface $menu; 

    /**
     * Create a new MenuController instance.
     *
     * @param MenuRepositoryInterface $menuRepository
     * @return void
     */
    function __construct(
        MenuRepositoryInterface $menuRepository
    )
    {
        $this->menu = $menuRepository;
    }


    public function getMenu()
    {
        $menu = $this->menu->get(auth()->user()?->menu?->id);
        
        return new MenuResource($menu);
    }

    /**
     * Update the user menu 
     * 
     * @return MenuResource
     */
    public function updateMenu(MenuRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();

        $menu = $user->menu 
            ? $this->menu->update($user->menu->id, $validatedData)
            : $this->menu->create($validatedData);
  
        $resource = new MenuResource($menu);
        $resource->additional([
            "message" => "message.updated"
        ]);

        return $resource;
    }
}
