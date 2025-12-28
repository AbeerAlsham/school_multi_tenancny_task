<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $data = $this->authService->login($request->only('email', 'password'));
        if (!$data) {
            return $this->unprocessableResponse('password or username not correct');
        }
        return $this->okResponse([
            'user' => $data['user'],
            'access_token' => $data['access_token'],
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return $this->noContentResponse();
    }
}
