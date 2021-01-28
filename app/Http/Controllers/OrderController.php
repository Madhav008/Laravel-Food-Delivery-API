<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
   
    public function index()
    {
        return Order::all();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_item_id' => 'required',
            'user_id' => 'required',
            'total_quantity' => 'required'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }
        $orderIem = $request->isMethod('put') ? Order::findOrFail($request->orderIem_id) : new Order;
        $orderIem->id = $request->input('order_id');
        $orderIem->order_item_id = $request->input('order_item_id');
        $orderIem->user_id = $request->input('user_id');
        $orderIem->total_quantity = $request->input('total_quantity');


        if ($orderIem->save()) {
            return $orderIem;
        }
    }

    public function show($id)
    {
        $orderIem = Order::findOrFail($id);
        return $orderIem;
    }


    public function edit(Order $order)
    {
        //
    }

   
    public function update(Request $request, Order $order)
    {
        //
    }

    
    public function destroy($id)
    {
        $orderIem = Order::destroy($id);
        return $orderIem;
    }
}
