<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Services\UserServices;

class UserController extends Controller
{
    public function __construct(protected UserServices $userServices)
    {
    }

    /**
     * createUser
     *
     * @param  mixed $request
     * @return void
     */
    public function createUser(CreateUserRequest $request)
    {
        try {
            $user = $this->userServices->createUser($request);
            return response()->json(['success' => true, 'data' => ['message' => $user]]);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
