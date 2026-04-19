<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    use HasFactory;

    protected $table = 'business_info';

    protected $fillable = [
        'company_name',
        'contact_person',
        'company_email',
        'company_contact_number',
        'location',
    ];

}
