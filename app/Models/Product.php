<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'short_description', 'description', 'price', 'stock_quantity',
        'category_id', 'image_url', 'is_active','user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
