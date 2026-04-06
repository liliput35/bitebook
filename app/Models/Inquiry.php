<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'booking_id',
        'sender_id',
        'parent_id',
        'message',
        'status',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    public function replies()
    {
        return $this->hasMany(Inquiry::class, 'parent_id')->with('sender');
    }

    public function parent()
    {
        return $this->belongsTo(Inquiry::class, 'parent_id');
    }
}