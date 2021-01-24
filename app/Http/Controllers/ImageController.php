<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
        //Get the file
        $img=$request->file('file');
        //change file name
        $imageName=time().'.'.$img->extension();
        //store image
        $img->storeAs('public/images',$imageName);

        $image= new Image();
        $image->imageUrl=$imageName;
        $image->save();

        return ["result"=>$image];
    }
}
