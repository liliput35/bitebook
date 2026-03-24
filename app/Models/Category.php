<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    // Relationships
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function bundleRequirements()
    {
        return $this->hasMany(BundleRequirement::class);
    }
}