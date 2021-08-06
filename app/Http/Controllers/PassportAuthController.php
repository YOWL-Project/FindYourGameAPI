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

        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:users',

            'email' => 'required|email|unique:users',

            'password' => 'required',

        ]);

   

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }

   

        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $user['token'] =  $user->createToken('MyApp')->accessToken;

        $user['name'] =  $user->name;

        $user['admin'] = $user->admin;

   

        return $this->sendResponse($user,'Votre compte a été enregistré avec succès');

    }

   

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 

            $user['token'] =  $user->createToken('MyApp')->accessToken;    

            return $this->sendResponse($user, 'User login successfully.');

        } 

        else{ 

            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

        } 

    }
}
