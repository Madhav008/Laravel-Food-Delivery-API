<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id','user_id','status','payment_type','amount'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
