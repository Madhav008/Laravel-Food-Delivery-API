<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products =Products::all();
        return $products;
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'restaurant_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'image_url'=>'required|string'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }
        $products=$request->isMethod('put')?Products::findOrFail($request->products_id): new Products;
        $products->id=$request->input('product_id');
        $products->name=$request->input('name');
        $products->description=$request->input('description');
        $products->restaurant_id=$request->input('restaurant_id');
        $products->category_id=$request->input('category_id');
        $products->price=$request->input('price');
        $products->image_url=$request->input('image_url');

        if($products->save()){
            return $products;
        }
    }

  public function show($id)
    {
        $products=Products::findOrFail($id);
        return $products;
    }

 
    public function update(Request $request, $id)
    {
       
        $products = Products::findOrFail($id);

        $products->update($request->all());
        
        if ($products->save()) {
            return $products;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=Products::destroy($id);
        return $products;
    }
}
