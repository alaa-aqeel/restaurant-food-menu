<?php 

namespace App\Interfaces;

interface FoodRepositoryInterface extends BaseRepositoryInterface
{

    public function getAll();
    public function deleteFood(int $id);
    public function updateFood(int $id, array $data);
    public function findOrFail(int|null $id);
}