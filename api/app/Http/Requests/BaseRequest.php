<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponser;
use Illuminate\Contracts\Validation\Validator;
use App\Enums\HttpStatus;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    use ApiResponser;

    protected function failedValidation(Validator $validator)
    {
        $exception = new \Exception('Validation Failed');
        $response = $this->errorResponse($exception, HttpStatus::UNPROCESSABLE_ENTITY, $validator->errors());

        throw new ValidationException($validator, $response);
    }
}
