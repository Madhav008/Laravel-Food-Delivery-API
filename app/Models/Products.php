<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'restaurant_id',
        'category_id',
        'price',
        'discount',
        'image_url',
    ];


    public function reastaurants(){
        return $this->belongsTo(Restaurants::class,'restaurant_id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }
}
