<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $category; 

    /**
     * Create a new AuthController instance.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     * @return void
     */
    function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->category = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CategoryResource
     */
    public function index()
    {   

        // sleep(5);
        $categories = $this->category->all();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        $category = $this->category->create($validatedData);
        $resource = new CategoryResource($category);
        $resource->additional([
            'message' => __('messages.created'),
        ]);

        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequestt  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $validatedData = $request->validated();

        $category = $this->category->update($id, $validatedData);
        $resource = new CategoryResource($category);
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
    public function destroy($id)
    {
        $this->category->delete($id);

        return response()->json([
            'message' => __('messages.deleted'),
        ]);
    }
}
