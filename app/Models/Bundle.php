<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bundle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price_per_head',
        'image',
    ];

    // Relationships
    public function requirements()
    {
        return $this->hasMany(BundleRequirement::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default.png'); // fallback
    }
}