<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserCardServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;


class UserCardController extends Controller
{

    private $userCardService;

    public function __construct(UserCardServiceInterface $userCardService)
    {
        $this->userCardService = $userCardService;
    }


    public function createCard(int $userId, CreateCardRequest $request){

        $response = $this->userCardService->create($userId, $request->all());
        return response()->json($response, 201);


    }


}
