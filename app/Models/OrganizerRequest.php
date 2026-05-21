<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class OrganizerRequest extends Model
{
    //
    protected $fillable = [
        'user_id',
        'full_name',
        'contact_email',
        'phone',
        'organization_name',
        'event_details',
        'id_proof',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}