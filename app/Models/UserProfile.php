<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'business_type_id',
        'role_id',
        'address',
        'postal_code',
        'country',
        'city',
        'organization_id',
    ];

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }
}
