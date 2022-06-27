<?php 

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository  implements UserRepositoryInterface
{

    function __construct()
    {
        $this->setModel(User::class);
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
            
            $filter = $filter
                    ->where("name", "LIKE", "%{$args['search']}%")
                    ->orWhere("phone", "LIKE", "%{$args['search']}%")
                    ->orWhere("username", "LIKE", "%{$args['search']}%");
        }

        return $filter->get();
    }


    private function encryptPassword(mixed &$data)
    {
        if (isset($data['password']) && !is_null($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
    }
    
    public function create(array $data)
    {
        $this->encryptPassword($data);
        return parent::create($data);
    }

    public function update(int $id, array $data)
    {
        $data['is_admin'] = (int)isset($validatedData['is_admin']);
        $this->encryptPassword($data);
        return parent::update($id, $data);
    }
}