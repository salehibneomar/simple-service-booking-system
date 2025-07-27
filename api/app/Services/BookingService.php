<?php

namespace App\Services;
use App\Models\Booking;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class BookingService
{

    public function getAll(array $filters = []) : LengthAwarePaginator {
        $orderBy = $filters['order_by'] ?? 'id';
        $orderDir = $filters['order_dir'] ?? 'desc';
        $perPage = $filters['per_page'] ?? 20;

        return Booking::with('service', 'user')
            ->orderBy($orderBy, $orderDir)
            ->paginate($perPage);
    }

    public function getCustomerBookings(array $filters = []): LengthAwarePaginator {
        $customerId = Auth::user()->id;
        $perPage = $filters['per_page'] ?? 20;

        return Booking::where('user_id', $customerId)
            ->with('service', 'user')
            ->orderBy('booking_date', 'desc')
            ->paginate($perPage);
    }

    public function create(array $data) : Booking {
        $booking = new Booking();
        $booking->user_id = Auth::user()->id;
        $booking->fill($data);
        $booking->save();

        return $booking;
    }

    public function update(string $id, array $data) : Booking {
        $booking = Booking::findOrFail($id);
        $booking->fill($data);
        $booking->save();

        return $booking;
    }

}
