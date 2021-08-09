<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)

    {
        $data = $request->all();

        // make sure the request have all necessary input

        $validator = Validator::make($data, [

            'username' => 'required|unique:users',

            'email' => 'required|email|unique:users',

            'password' => 'required|confirmed',

            'birthdate' => 'required|date',

            'isadmin' => 'sometimes|boolean',

        ]);

   

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

   

        // register new user in database

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user['token'] =  $user->createToken('MyApp')->accessToken;

        $message = "SUBSCRIPTION CONFIRMED !";

   

        return $this->sendResponse($user,$message, 201);

    }

   

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)

    {

        // make sure the request have all necessary input

        $validator = Validator::make($request->all(), [

            'username' => 'required|exists:users',

            'password' => 'required',

        ]);

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

        //check if input are valid and exist in database

        if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])){

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 401);

        } 

        $user = Auth::user();

        $user['token'] =  $user->createToken('MyApp')->accessToken;

        $message = 'User login successfully.';

        return $this->sendResponse($user, $message, 200);

    }



     /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */

    public function logout(Request $request)

    {

        // if (!Auth::check()) {
        //     return $this->sendError('User not Authenticated', ['error' => 'Not Authenticated'], 401);
        // }

        $user = Auth::check();

        return $user;

        // $user->token()->revoke();

        // return $this->sendResponse($user, "LOGOUT SUCCESFULLY !", 200);

    }
}
