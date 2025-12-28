<?php

namespace App\Services\V1;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
   
    public function login(array $credentials)
    {
          $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }
        $token = $user->createToken('schoolSixth')->plainTextToken;

        return [
            'user'=>$user,
            'access_token' => $token,
        ];
    }
    public function logout($user)
    {
        $user->tokens()->delete();
    }
}
