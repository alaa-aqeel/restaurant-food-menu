<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $user; 

    /**
     * Create a new AuthController instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = $this->user->filter([
            "search" => $request->get("search", '')
        ]);

        return view("user", [
            "users" => $users,
            "cols"  => [
                ["name" => "id", "text" => "ID"],
                ["name" => "name", "text" => "Name"],
                ["name" => "username", "text" => "Username"],
                ["name" => "phone", "text" => "Phone"],
                ["name" => "expire_at", "text" => "Expire At"],
                ["name" => "is_admin", "text" => "Is Admin"],
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create_user", [
            "action" => route("users.store")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $this->user->create($validatedData);

        return back()->with("message", __("messages.success_created"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->get($id);

        return view("create_user", [
            "user" => $user,
            "action" => route("users.update", $id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $validatedData = $request->validated();

        // Is checkbox  set 0 or 1 
        $validatedData['is_admin'] = (int)isset($validatedData['is_admin']);
        $this->user->update($id, $validatedData);
       
        return back()->with("message", __("messages.success_updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->delete($id);

        return back()->with("message", __("messages.success_deleted"));
    }
}
