<?php 

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    /**
     * Set model 
     * 
     * @param  $model
     * @return void 
     */
    public function setModel($model); 


    /**
     * Get all records
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * filter records
     * 
     * @param array $args
     * @param int $limit = 8
     * @param string $sort = id 
     * @return Collection 
     */
    public function filter(array $args, int $limit=8, $sort="id") ;


    /**
     * Paginate records 
     * 
     * @param int $limit 
     * @return Collection 
     */
    public function paginate($limit=8);

    /**
     * Get one record by id
     * 
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get(int $id);

    /**
     * Create a new record
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update a record by id 
     * 
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data);

    /**
     * Delete a record by id
     * 
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(int $id);
}