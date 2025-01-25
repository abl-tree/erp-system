<?php

namespace App\Models;

use App\Listeners\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BusinessType extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving([GenerateSlug::class, 'handle']);
    }

    public function setSlugAttribute($value)
    {
        $value = $this->attributes['name'];
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
