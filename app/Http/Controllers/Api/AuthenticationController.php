<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\AuthenticationFormRequest;
use App\Services\UserService;

class AuthenticationController extends ApiController
{
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function login(AuthenticationFormRequest $req)
    {
        $payload = $req->validated();
        $email   = $payload['email'];
        $user    = $this->service->getUserByEmail($email);
        $token   = $this->service->token($user);
        return $this->responseSuccessAuthorization($token);
    }
}
