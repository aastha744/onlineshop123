<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'summary', 'details', 'price', 'discount_price', 'stock_qty', 'images', 'category_id', 'brand_id', 'status', 'featured'];

    protected $casts = [
      'images' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailAttribute()
    {
        return $this->images[0];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
