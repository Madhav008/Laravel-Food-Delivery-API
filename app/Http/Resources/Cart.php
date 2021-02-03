<?php

namespace App\Http\Resources;

use App\Models\Products;
use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'products'=>Products::find($this->product_id),
            'cart_prod_qty'=>$this->cart_prod_qty,
        ];
    }
}
