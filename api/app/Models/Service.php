<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Booking;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'timeline'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id', 'id');
    }
}
