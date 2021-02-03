<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartCollection;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products = array();
        // if($request->user()->id){

        // return Cart::with('products')->get();

        // }

        // return new CartCollection(Cart::where('user_id',$request->user()->id)->get());
        $products = Cart::with('products')->where('user_id', $request->user()->id)->get();
        return $products;
    }




    public function store(Request $request)
    {

        if ($request->user()->id) {
            $cart =  new Cart();
            $cart->user_id = $request->user()->id;
            $cart->product_id = $request->product_id;
            $cart->cart_prod_qty = $request->cart_prod_qty;
            $cart->save();
        } else {
            return "user not login";
        }
    }

    public function show(Cart $cart)
    {
        //
    }



    public function update(Request $request, $id)
    {
        $product = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->update(['cart_prod_qty' => $request->cart_prod_qty]);

        return $product;
    }

    public function destroy(Request $request, $id)
    {

        return Cart::where('user_id', $request->user()->id)->where('product_id', $id)->delete();
    }
}
