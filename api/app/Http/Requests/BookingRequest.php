<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use App\Enums\BookingStatus;

class BookingRequest extends BaseRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'service_id' => 'required|integer|exists:services,id',
                'booking_date' => 'required|date|after_or_equal:today',
            ];
        }
        if ($this->isMethod('put')) {
            $rules = [
                'status' => 'required:in:' . implode(',', BookingStatus::values()),
            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Service is required.',
            'service_id.exists' => 'Selected service does not exist.',
            'booking_date.required' => 'Booking date is required.',
            'booking_date.date' => 'Booking date must be a valid date.',
            'booking_date.after_or_equal' => 'Booking date cannot be in the past.',
        ];
    }
}
