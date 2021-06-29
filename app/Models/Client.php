<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'name',
        'email',
        'phone',
        'haircut',
        'message',
    ];

    public function booking()
    {
        $this->hasOne(Booking::class);
    }
}
