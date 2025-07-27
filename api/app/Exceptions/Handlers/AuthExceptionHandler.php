<?php

namespace App\Exceptions\Handlers;

use App\Traits\ApiResponser;
use App\Enums\HttpStatus;

class AuthExceptionHandler
{
    use ApiResponser;

    public function handle(\Exception $exception)
    {
        return $this->errorResponse($exception, HttpStatus::UNAUTHORIZED, $exception->getMessage());
    }
}
