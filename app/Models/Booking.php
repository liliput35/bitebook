<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'bundle_id',
        'event_type',
        'venue',
        'event_date',
        'guest_count',
        'status',
        'total_price',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}