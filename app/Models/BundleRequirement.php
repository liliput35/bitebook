<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleRequirement extends Model
{
    protected $fillable = [
        'bundle_id',
        'category_id',
        'required_quantity',
    ];

    // Relationships
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}