<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'restaurant_id',
        'image_url'
    ];

    public function restaurants(){
        return $this->belongsTo(Restaurants::class,'restaurant_id');
    }

    public function products(){
        return $this->hasMany(Products::class);
    }

}
