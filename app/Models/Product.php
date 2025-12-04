<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'description',
        'price',
        'slug',
        'stock',
        'image',
        'category_id'
    ];

    // Auto slug when name is set
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        // simple slug
        $slug = Str::slug($value);

        // make it unique
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $this->attributes['slug'] = $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
