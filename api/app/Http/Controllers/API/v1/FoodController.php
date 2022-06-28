<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Http\Resources\FoodResource;
use App\Interfaces\FoodRepositoryInterface;
use Illuminate\Http\Request;

class FoodController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return FoodResource
     */
    public function index($category)
    {   
        $categories = $this->food->getAll($category);

        return FoodResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FoodRequest  $request
     * @return FoodResource
     */
    public function store($category, FoodRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['category_id'] = $category;

        $food = $this->food->create($validatedData);
        $resource = new FoodResource($food);
        $resource->additional([
            'message' => __('messages.created'),
        ]);

        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FoodRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($category, FoodRequest $request, $id)
    {
        $validatedData = $request->validated();

        $food = $this->food->updateFood($category, $id, $validatedData);
        $resource = new FoodResource($food);
        $resource->additional([
            'message' => __('messages.updated'),
        ]);

        return $resource;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category, $id)
    {
        $this->food->deleteFood($category, $id);

        return response()->json([
            'message' => __('messages.deleted'),
        ]);
    }
}
