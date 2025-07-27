<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_id' => 'required|integer|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ];
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
