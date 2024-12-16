<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BusinessType extends Model
{
    protected $fillable = ['name', 'slug'];

    public function setSlugAttribute($value)
    {
        // Generate an initial slug
        $slug = Str::slug($value);
    
        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $counter = 1;

        while (BusinessType::whereSlug($slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function businessFeatures()
    {
        return $this->belongsToMany(BusinessFeatures::class, 'business_type_features', 'business_type_id', 'business_feature_id');
    }
}
