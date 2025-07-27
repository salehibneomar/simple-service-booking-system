<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Enums\ServiceStatus;

class ServiceOperationRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:10000',
            'price' => 'required|numeric',
            'status' => 'required|in:' . implode(',', ServiceStatus::values()),
            'timeline' => 'required|date',
        ];
    }
}
