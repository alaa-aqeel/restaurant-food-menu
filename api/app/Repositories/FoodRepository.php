<?php 

namespace App\Repositories;

use App\Interfaces\FoodRepositoryInterface;
use App\Models\Food;

class FoodRepository extends BaseRepository  implements FoodRepositoryInterface
{

    function __construct()
    {
        $this->setModel(Food::class);
    }

    private function getMenu()
    {
        return auth()->user()->menu;
    }

    private function filterByCategory($id)
    {
        $menu = $this->getMenu();
        return  $this->model::whereHas("category", function ($q) use($menu, $id){
                            $q->where("menu_id", $menu->id);
                            if ($id) {
                                $q->where("category_id", $id);
                            }
                            return $q;   
                        });
    }

    public function findOrFail(int|null $categoryId, int|null $id)
    {

        $food = $this->filterByCategory($categoryId)
                    ->where('id', $id)
                    ->first();
        if ( $food ) {
            return $food;
        }

        abort(response()->json([
            "message" => __("messages.not_found")
        ], 404));
    }

    public function getAll(int|null $categoryId)
    {
        return $this->filterByCategory($categoryId)->get();
    }

    public function create(array $data)
    {
        $this->uploadImage($data);
        $this->setSlugField($data, 'name');
        return parent::create($data);
    }

    public function updateFood(int|null $categoryId, int $id, array $data)
    {
        $food = $this->findOrFail($categoryId, $id);
        $this->setSlugField($data, 'name');
        $this->uploadImage($data);
        $food->update($data);
        return $food;
    }


    public function deleteFood(int|null $categoryId, int $id)
    {
        $this->findOrFail($categoryId, $id)->delete();
    }
}