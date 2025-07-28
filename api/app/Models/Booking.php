<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Service;
use App\Models\User;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }


    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = (string) $value;
    }
}
