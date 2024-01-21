<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\AuthenticationFormRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

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
    public function logout()
    {
        $userId = Auth::user()->id;
        $logout = $this->service->logout($userId);
        if($logout){
            return $this->responseSuccessLogout();
        }
    }
}
