<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function show(User $users)
    {
    // $this->authorize('view', $appointments);
        return $users;
    }
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);

            }
        }catch(JWTException $e ){
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'birthdate' => 'required',
            'idcard' => 'required|integer|max:10',
            'phone' => 'required|integer|max:11',
            'address' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:6|confirmed',
            'specialty_id' => 'required',
            //'image' => 'required|image|dimensions:min_width=200,min_height=200',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'idcard' => $request->get('idcard'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'email' => $request->get('Email'),
            'password' => Hash::make($request->get('password')),
            'specialty_id' => $request->get('specialty_id'),
            //'image' => $request->get('image'),

        ]);

        /*    $user = new User($request->all());
            $path = $request->image->register('public/users');
            $user->image = $path;
            $user->save();*/

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }
    public function getAuthenticatedUser(){
        try{
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }
        }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['token expired'], $e->getStatusCode());
        }catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
}
