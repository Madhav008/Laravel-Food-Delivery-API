<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    
    public function index()
    {
        return OrderItem::all();
        
    }

    
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'price' => 'required',
            'quantity'=>'required'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }
        $orderIem = $request->isMethod('put') ? OrderItem::findOrFail($request->orderIem_id) : new OrderItem;
        $orderIem->id = $request->input('order_item_id');
        $orderIem->product_id = $request->input('product_id');
        $orderIem->price = $request->input('price');
        $orderIem->quantity = $request->input('quantity');


        if ($orderIem->save()) {
            return $orderIem;
        }
    }

    
    public function show($id)
    {
        $orderIem = OrderItem::findOrFail($id);
        return $orderIem;
    }
  
 
   
    public function update(Request $request,$id)
    {
      
        $orderIem = OrderItem::findOrFail($id);

        $orderIem->update($request->all());
        
        if ($orderIem->save()) {
            return $orderIem;
        }
    }

    public function destroy($id)
    {
        $orderIem = OrderItem::destroy($id);
        return $orderIem;
    }
}
