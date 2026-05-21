<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Booking;

class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',

        'description',

        'venue',

        'date',

        'time',

        'price',

        'image',

        'payment_qr',

        'organizer_id',

        'total_seats',

        'available_seats',

        'status',

        'entry_code',
        'event_type',
        'remaining_seats',
        'standing_limit'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function seats()
{
    return $this->hasMany(Seat::class);
}
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

// class Event extends Model
// {
//     use SoftDeletes;

//     protected $fillable = [
//         'title',
//         'description',
//         'event_date',
//         'total_seats',
//         'available_seats',
//         'ticket_price',
//         'status'
//     ];

//     public function bookings()
//     {
//         return $this->hasMany(Booking::class);
//     }
// }
