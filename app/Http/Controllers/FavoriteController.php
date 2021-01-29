<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    
    public function index()
    {
        $favs =  Favorite::all();

        foreach($favs as $value){
            return $value->products;
        }
    
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
        $favorites = $request->isMethod('put') ? Favorite::findOrFail($request->favorites_id) : new Favorite;
        $favorites->id = $request->input('favorite_id');
        $favorites->product_id = $request->input('product_id');
        $favorites->user_id = $request->input('user_id');

        if ($favorites->save()) {
            return $favorites;
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

    public function destroy($id)
    {
        $favorites = Favorite::destroy($id);
        return $favorites;
    }
}
