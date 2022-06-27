<?php 

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class BaseRepository  implements BaseRepositoryInterface
{





    /**
     * Default field search for filter  func
     * 
     * @var String 
     */
    protected string $defaultFieldSearch = "name";

    /**
     * @var Model 
     */
    protected $model;


    /**
     * Set model 
     * 
     * @param $model 
     * @return void 
     */
    public function setModel($model) 
    {
        $this->model = $model;
    }


    /**
     * Update fields 
     * 
     * @param mixed $data
     * @return void 
     */
    public function updateField(mixed &$data, $key, $value) 
    {
        if(isset($data[$value])){
            $data[$key] =  $data[$value] ;
        }
    }


    /**
     * Get all records
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model::all();
    }

    /**
     * filter records
     * 
     * @param array $args
     * @param string $sort = id 
     * @param int $limit = 8
     * @return Collection 
     */
    public function filter(array $args, int $limit=8, $sort="id") 
    {
        $filter = $this->model::orderBy($sort);

        if (isset($args['search'])){
            
            $filter = $filter->where($this->defaultFieldSearch, "LIKE", "%{$args['search']}%");
        }

        return $filter->paginate($limit);
    }

    /**
     * Paginate records 
     * 
     * @param int $limit 
     * @return Collection 
     */
    public function paginate($limit=8) 
    {
        return $this->model::paginate($limit);
    }

    /**
     * Get one record by id
     * 
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get(int|null $id)
    {
        return $this->model::findOrFail($id);
    }

    public function uploadImage(mixed &$data)
    {
        if (isset($data['image'])) {
            $path =  $data['image']->store("public/images");
            $data['image'] = Storage::url($path);
        }
    }

    /**
     * Create a new record
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $data['user_id'] = auth()->id();
        return $this->model::create($data);
    }

    /**
     * Update a record by id 
     * 
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $record = $this->get($id);
        $record->update($data);

        return $record;
    }

    /**
     * Delete a record by id 
     * 
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $record = $this->get($id);
        $record->delete();

        return $record;
    }


}