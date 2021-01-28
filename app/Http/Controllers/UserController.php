<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|string',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|max:255'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        //create user

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        //token 

        return $this->getResponse($user);
    }

    function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:255'
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            return $this->getResponse($user);
        }
    }
    public function update(Request $request)
    {
       
        $user = $request->user();

        $user->update($request->all());
        
        if ($user->save()) {
            return $user;
        }
    }
    public function logout(Request $request){
         $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();

         return response(['Succesfully loggged out']);
    }

    public function user(Request $request){
        return $request->user();
    }

   
    private function getResponse(User $user)
    {
        $token = $user->createToken('my-app-token');
        $token->expires_at = Carbon::now()->addWeeks(1);
        $response = [
            'accessToken' => $token->plainTextToken,
            'tokenType' => 'Bearer',
            'expireAt' => Carbon::parse($token->expires_at)->toDateTimeLocalString()
        ];
        return response($response, 201);
    }
}
