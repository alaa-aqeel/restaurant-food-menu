<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use App\Interfaces\UserRepositoryInterface;

class AccountController extends Controller
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
    function __construct(
        UserRepositoryInterface $userRepository,
    )
    {
        $this->user = $userRepository;
    }

    /**
     * Display a profile of the user.
     * 
     * @return AccountResource
     */
    public function getAccount()
    {
        $resource = new AccountResource(auth()->user());
        return $resource;
    }

    /**
     * Update the user's profile.
     * 
     * @param AccountRequest $request
     * @return AccountResource
     */
    public function updateAccount(AccountRequest $request) 
    {
        $validatedData = $request->validated();
        $user = $this->user->update(auth()->id(), $validatedData);
        $resource = new AccountResource($user);
        $resource->additional([
            "message" => "message.updated"
        ]);

        return $resource;
    }



}
