<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getToken(LoginRequest $request)
    {

        $response = $this->userService->getToken($request->user, $request->password);
        return response()->json($response, 200);
    }

    public function createUser(CreateUserRequest $request)
    {

        $response = $this->userService->create($request->all());
        return response()->json($response, 201);
    }

    public function updateUser(int $id, UpdateUserRequest $request)
    {
        $response = $this->userService->update($id, $request->all());
        return  response()->json($response, 200);
    }

    public function deleteUser(int $id){

        $response = $this->userService->delete($id);
        return response()->json($response, 200);

    }
}
