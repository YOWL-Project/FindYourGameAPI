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

            'name' => 'required|unique:users',

            'email' => 'required|email|unique:users',

            'password' => 'required|confirmed',

            'admin' => 'sometimes|digits_between:0,1'

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

            'email' => 'required|email|exists:users',

            'password' => 'required',

        ]);

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

        //check if input are valid and exist in database

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 401);

        } 

        $user = Auth::user();

        $user['token'] =  $user->createToken('MyApp')->accessToken;

        $message = 'User login successfully.';

        return $this->sendResponse($user, $message, 200);

    }
}
