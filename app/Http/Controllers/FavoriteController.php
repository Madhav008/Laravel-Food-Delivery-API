<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    
    public function index(Request $request)
    {

        $user_id = $request->user()->id;

        $favs =  Favorite::where('user_id',$user_id)->get();

        $favproducts= array();
        foreach($favs as $value){
            
            array_push($favproducts,$value->products) ;

        }
        return $favproducts;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|max:255|',
            'user_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }
        if($request->user()->id == $request->input('user_id')){

        
        $favorites = $request->isMethod('put') ? Favorite::findOrFail($request->favorites_id) : new Favorite;
        $favorites->id = $request->input('favorite_id');
        $favorites->product_id = $request->input('product_id');
        $favorites->user_id = $request->input('user_id');

        if ($favorites->save()) {
            return $favorites;
        }
    }
    }

    public function show($id)
    {
        $favorites = Favorite::findOrFail($id);
        return $favorites;
    }

 
    public function update(Request $request, $id)
    {
        $fav = Favorite::findOrFail($id);

        $fav->update($request->all());
        
        if ($fav->save()) {
            return $fav;
        }
    }

    public function destroy(Request $request,  $id)
    {
        
        $userid =$request->user()->id; 
        $favs =  Favorite::where('user_id',$userid)->where('product_id',$id)->delete();
        
        return $favs;
       
    }
}
