<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login (LoginRequest $loginrequest){
    $user_data = $loginrequest->only('email','password');
    try{
        if ( !$token = JWTAuth::attempt($user_data) ){
            return response()->json([
                "error"=> "error de datos ingresados"
            ]);
        }
    }catch (\Exception $e){
        return response()->json(
            [
                "error"=> "usuario no existe"
            ],500
        );
    }
    return response()->json(compact('token'));
    }
     public function register(RegisterRequest $request){

        $user = User::create(
            [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            ]
        );
        $token=JWTAuth::fromUser($user);

        return response()->json(
            [
                'user'=>$user,
                'token'=>$token
            ]
            );
     }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
