<?php

namespace App\Models;

use App\Listeners\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BusinessFeatures extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving([GenerateSlug::class, 'handle']);
    }

    public function setSlugAttribute($value)
    {
        // Generate an initial slug
        $slug = Str::slug($value);
    
        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $counter = 1;

        while (BusinessFeatures::whereSlug($slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function businessType()
    {
        return $this->belongsToMany(BusinessType::class, 'business_type_features', 'business_feature_id', 'business_type_id');
    }
}
