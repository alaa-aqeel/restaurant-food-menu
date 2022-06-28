<?php 

namespace App\Repositories;

use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuRepository extends BaseRepository  implements MenuRepositoryInterface
{

    function __construct()
    {
        $this->setModel(Menu::class);
    }




    public function create(array $data)
    {
        $this->setSlugField($data, 'title');
        $this->uploadImage($data);
        return parent::create($data);
    }

    public function update(int $id, array $data)
    {
        $this->setSlugField($data, 'title');
        $this->uploadImage($data);
        return parent::update($id, $data);
    }

}