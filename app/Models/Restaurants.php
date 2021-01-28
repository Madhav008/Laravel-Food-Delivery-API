<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description'
    ];

    public function products(){
        return $this->hasMany(Products::class);
    }

    public function category(){
        return $this->hasMany(Category::class);
    }
    
}
