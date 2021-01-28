<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable =['product_id','user_id'];

    public function products(){
        return $this->belongsTo(Products::class,'product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
