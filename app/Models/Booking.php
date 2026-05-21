<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'tickets',
        'total_price',
        'payment_screenshot',
        'ticket_number',
        'ticket_id',
        'qr_code'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}




// namespace App\Models;

//  use Illuminate\Database\Eloquent\Model;

// class Booking extends Model
// {
//     protected $fillable = [
//         'user_id',
//         'event_id',
//         'tickets',
//         'total_price'
//     ];

//     public function event()
//     {
//         return $this->belongsTo(Event::class);
//     }
// }



// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Booking extends Model
// {
//     protected $fillable = [

//         'user_id',

//         'event_id',

//         'payment_screenshot',

//         'ticket_number'

//     ];

//     public function event()
//     {
//         return $this->belongsTo(Event::class);
//     }

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }
// }
