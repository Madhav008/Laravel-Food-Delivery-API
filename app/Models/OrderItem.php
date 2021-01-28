<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable =[
        'product_id','price','quantity'
    ];

    public function products(){
        return $this->belongsTo(Products::class,'product_id');
    }

    public function order(){
        return $this->hasOne(Order::class);
    }

}
