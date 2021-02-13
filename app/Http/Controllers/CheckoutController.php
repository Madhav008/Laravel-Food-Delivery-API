<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {
        return Checkout::with('cart')->where('user_id', $request->user()->id)->get();
    }


    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'amount' => 'required',
            'cart_id' => 'required',
            'payment_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        $checkout = $request->isMethod('put') ? Checkout::findOrFail($request->checkout_id) : new Checkout;

        $checkout->cart_id = $request->input('cart_id');
        $checkout->user_id = $request->user()->id;
        $checkout->status = $request->input('status');
        $checkout->payment_type = $request->input('payment_type');
        $checkout->amount = $request->input('amount');


        if ($checkout->save()) {
            return $checkout;
        }
    }


    public function show(Request $request, $id)
    {
        $orderIem = Checkout::where('user_id', $request->user()->id)
            ->where('id', $id)->get();
        return $orderIem;
    }




    public function update(Request $request, $id)
    {
        $order = Checkout::where('checkout_id', $id)
            ->where('user_id', $request->user()->id)
            ->update($request->all());

        if ($order->save()) {
            return $order;
        }
    }

    
    public function destroy(Request $request,$id)
    {
        return Checkout::where('user_id', $request->user()->id)->where('checkout_id', $id)->delete();
    }
}
