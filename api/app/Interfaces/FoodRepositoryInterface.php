<?php 

namespace App\Interfaces;

interface FoodRepositoryInterface extends BaseRepositoryInterface
{

    public function getAll(int|null $categoryId);
    public function deleteFood(int|null $categoryId, int $id);
    public function updateFood(int|null $categoryId, int $id, array $data);
    public function findOrFail(int|null $categoryId, int|null $id);
}