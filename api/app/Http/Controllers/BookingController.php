<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookingService;
use \Exception;
use App\Traits\ApiResponser;
use App\Http\Requests\BookingRequest;
use App\Enums\HttpStatus;
use App\Enums\CrudStatus;

class BookingController extends Controller
{

    use ApiResponser;

    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getAll(Request $request)
    {
        try{
            $bookings = $this->bookingService->getAll($request->all());
            return $this->listDataResponse($bookings);
        }
        catch(Exception $e){
            return $this->errorResponse($e);
        }
    }

    public function getCustomerBookings(Request $request)
    {
        try{
            $bookings = $this->bookingService->getCustomerBookings($request->all());
            return $this->listDataResponse($bookings);
        }
        catch(Exception $e){
            return $this->errorResponse($e);
        }
    }

    public function store(BookingRequest $request)
    {
        try{
            $booking = $this->bookingService->create($request->validated());
            return $this->singleModelResponse($booking, HttpStatus::CREATED, CrudStatus::CREATED->value);
        }
        catch(Exception $e){
            return $this->errorResponse($e);
        }
    }

    public function update(string $id, BookingRequest $request)
    {
        try{
            $booking = $this->bookingService->update($id, $request->validated());
            return $this->singleModelResponse($booking, HttpStatus::OK, CrudStatus::UPDATED->value);
        }
        catch(Exception $e){
            return $this->errorResponse($e);
        }
    }

}
