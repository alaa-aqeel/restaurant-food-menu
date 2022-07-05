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

    private function filterByMenu()
    {
        return $this->filter(['menu' => $this->getMenu()->id ]);
    }

    /**
     * filter records
     * 
     * @param array $args
     * @param int $limit = 8
     * @param string $sort = id 
     * @return Food 
     */
    public function filter(array $args, int $limit=8, $sort="id")
    {
        $filter = $this->model::orderBy($sort, "desc");
        

        if (isset($args['category']) && $args['category']) {
            $filter = $filter->where('category_id', $args['category']);
        }

        if (isset($args['menu'])) {
            $filter = $filter->where('menu_id', $args['menu']);
        }

        if (isset($args['is_available'])) {
            
            $filter = $filter->where('is_available', $args['is_available']);
        }

        return $filter; 
    }

    public function findOrFail(int|null $id)
    {

        $food = $this->filterByMenu()
                    ->where('id', $id)
                    ->first();
        if ( $food ) {
            return $food;
        }

        abort(response()->json([
            "message" => __("messages.not_found")
        ], 404));
    }

    public function getAll()
    {
        return $this->filterByMenu()->get();
    }

    public function create(array $data)
    {
        $data['menu_id'] = $this->getMenu()->id;
        $this->uploadImage($data);
        $this->setSlugField($data, 'name');
        $data['is_available'] = isset($data['is_available']) ? 1 : 0;
        return parent::create($data);
    }

    public function updateFood(int $id, array $data)
    {
        $food = $this->findOrFail($id);
        $this->setSlugField($data, 'name');
        $this->uploadImage($data);
        $data['is_available'] = isset($data['is_available']) ? 1 : 0;
        $food->update($data);
        return $food;
    }


    public function deleteFood(int $id)
    {
        $this->findOrFail($id)->delete();
    }
}