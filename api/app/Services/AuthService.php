<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserStatus;

class AuthService
{
    public function login (array $data) : array
    {
        extract($data);

        $isSuccessful = !!(Auth::attempt([
            'email' => $email,
            'password' => $password
        ]));

        $token = null;
        $user = null;
        $isActive = false;

        if($isSuccessful){
            /** @var User|null $user */
            $user = Auth::user();
            if (isset($user) && $user !==null) {
                $user->tokens()->delete();
                if($user->status == UserStatus::ACTIVE->value) {
                    $token = $user->createToken('api_token')->plainTextToken;
                    $isActive = true;
                }
            }
        }

        return [
            'attempt' => $isSuccessful,
            'user' => $user,
            'token' => $token,
            'status' => $isActive
        ];
    }

    public function logout(): User | null
    {
    /** @var User | null auth $user */
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }
        return $user;
    }

    public function register(array $data): User
    {
        extract($data);
        $password = Hash::make($password);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        $user->save();

        return $user;

    }

}
