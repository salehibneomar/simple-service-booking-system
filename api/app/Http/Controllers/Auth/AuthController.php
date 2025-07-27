<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Enums\HttpStatus;
use \Exception;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    use ApiResponser;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try{
            $authUser = $this->authService->login($request);
            if (!$authUser['attempt']) {
                return $this->errorResponse(new Exception('Invalid credentials'), HttpStatus::UNAUTHORIZED);
            }
            if(!$authUser['status']) {
                return $this->errorResponse(new Exception('Blocked'), HttpStatus::UNAUTHORIZED, 'Your account is blocked');
            }
            $loginData = [
                'token' => $authUser['token'],
                'user' => $authUser['user'],
            ];
            return $this->singleModelResponse($loginData, HttpStatus::OK, 'Login successful');
        }
        catch(Exception $e) {
        return $this->errorResponse($e);
        }
    }

    public function logout()
    {
        try {
            $user = $this->authService->logout();
            if (!$user) {
                return $this->errorResponse(new Exception('Logout failed'), HttpStatus::UNAUTHORIZED);
            }
            return $this->singleModelResponse($user, HttpStatus::OK, 'Logout successful');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }


}
