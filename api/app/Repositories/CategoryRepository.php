<?php 

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository  implements CategoryRepositoryInterface
{

    function __construct()
    {
        $this->setModel(Category::class);
    }

    private function getMenu()
    {
        return auth()->user()->menu;
    }

    /**
     * Get category or fial with 404 error
     * 
     * @param int $id
     * @return Category|null
     */
    public function get(int|null $id)
    {
        $categoy = $this->model::where("menu_id", $this->getMenu()?->id)
                ->where("id", $id);
        
        if ($categoy = $categoy->first()) {

            return $categoy;
        }

        abort(response()->json([
            "message" => __("messages.not_found")
        ], 404));
    }

    /**
     * Get all categories
     * 
     * @return Collection
     */
    public function all()
    {
        return $this->model::where("menu_id", $this->getMenu()?->id)->get();
    }

    /**
     * Create new category
     * 
     * @param array $data
     * @return Category
     */
    public function create(array $data)
    {
        $data['menu_id'] = $this->getMenu()?->id;
        $this->uploadImage($data);
        return parent::create($data);
    }

    /**
     * Update category by id 
     * 
     * @param int $id
     * @param array $data
     * @return Category
     */
    public function update(int $id, array $data)
    {
        $this->uploadImage($data);
        return parent::update($id, $data);
    }

}