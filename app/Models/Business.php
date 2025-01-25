<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'business_type_id',
        'state',
        'country',
        'custom_url'
    ];

    public function type()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }
    
}
