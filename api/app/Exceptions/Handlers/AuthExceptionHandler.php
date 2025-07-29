<?php

namespace App\Exceptions\Handlers;

use App\Traits\ApiResponser;
use App\Enums\HttpStatus;
use Illuminate\Auth\AuthenticationException;

class AuthExceptionHandler
{
    use ApiResponser;

    public function handle(AuthenticationException $exception)
    {
        return $this->errorResponse($exception, HttpStatus::UNAUTHORIZED, 'Unauthenticated');
    }
}
