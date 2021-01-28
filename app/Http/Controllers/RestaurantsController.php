<?php

namespace App\Http\Controllers;

use App\Models\Restaurants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Restaurants::all();

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'description' => 'required',
            'image_url'=>'required|string'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }
        $restaurants = $request->isMethod('put') ? Restaurants::findOrFail($request->restaurants_id) : new Restaurants;
        $restaurants->id = $request->input('restaurants_id');
        $restaurants->name = $request->input('name');
        $restaurants->description = $request->input('description');
        $restaurants->image_url= $request->input('image_url');

        if ($restaurants->save()) {
            return $restaurants;
        }
    }

    public function show($id)
    {
        $restaurants = Restaurants::findOrFail($id);
        return $restaurants;
    }


    public function update(Request $request,$id)
    {
       
        $restaurants = Restaurants::findOrFail($id);

        $restaurants->update($request->all());
        
        if ($restaurants->save()) {
            return $restaurants;
        }
    }

  
    public function destroy($id)
    {
        $restaurants = Restaurants::destroy($id);
        return $restaurants;
    }
}
