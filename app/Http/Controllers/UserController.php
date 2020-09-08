<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User as UserResource;


class UserController extends Controller
{
private static $messages =[
'name.required' => 'El nombre es obligatorio',
'lastname.required' => 'El apellido es obligatorio',
'birthdate.required' => 'La fecha es obligatoria y use el formato correcto',
'idcard.required' => 'La cedula  debe tener  10 digitos',
'phone.required' => 'El numero de telefono no debe tener mas de 11 digitos ',
'email.required' => 'El correo es obligatorio debe ser de maximo 50 caracteres',
];


    public function index()
    {
        return User::all();
    }

    public function show(User $users)
    {
        // $this->authorize('view', $appointments);
       return $users;

    }

    public function update(Request $request, User $users)
    {

        //$this->authorize('update', $users);


        $users->status = 'activo';
        //$appointments->update($appointments->all());
       // $users->update($request->all());
        $users->update($users->toArray());
        return response()->json($users, 200);



    }
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 400);

            }
        }catch(JWTException $e ){
            return response()->json(['message' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();

        return response()->json(compact('token', 'user'));
    }
    public function register(Request $request){

$status ='inactivo';
       // $validator = Validator::make($request->all(), [

        $request->validate([
            'name' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'birthdate' => 'required',
            'idcard' => 'required|integer|unique:users',//|max:11',
            'phone' => 'required|integer|unique:users',//|max:9',
            'address' => 'required|string|max:50',
            'email' => 'required|string|unique:users|email|max:50',
            'password' => 'required|string|min:6|confirmed',

            'status' => 'required',
        ],self::$messages);
        /*if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }*/
        $user = User::create([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'birthdate' => $request->get('birthdate'),
            'idcard' => $request->get('idcard'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            //'specialty_id' => $request->get('specialty_id'),
            'status' => $status,
           // 'role' => $request->get('role')

        ]);

        /*    $user = new User($request->all());
            $path = $request->image->register('public/users');
            $user->image = $path;
            $user->save();*/



        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'),201);
    }
    public function getAuthenticatedUser(){
        try{
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user not found'], 404);
            }
        }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json(['message' => 'token expired'], $e->getStatusCode());
        }catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'token_absent'], $e->getStatusCode());
        }
        return response()->json(new UserResource($user));
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }
}
