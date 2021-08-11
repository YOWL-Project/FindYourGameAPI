<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function index($page = 1, $limit = false)
    {
        $count = User::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $offset = ($page * $limit) - $limit;
        $users = User::all()->skip($offset)->take($limit);
        $message = 'Request Get User index successfull.';

        return $this->sendResponse([
            'users' => $users,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ], $message, 201);
    }
    // public function create() {

    // }
    // public function store() {

    // }
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('User not found', $e, 400);
        }

        $message = 'User successfully found';
        return $this->sendResponse([
            'user' => $user,
        ], $message, 201);
    }
    // public function edit($id) {

    // }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();

        // if ($data['username'] != $user->username) {
        $login_exists = User::where('id', '!=', $id)->where('username', $data['username'])->first();
        if (isset($login_exists)) {
            $message = 'The Login already exists';
            return $this->sendError($message, 400);
        }
        // }

        // if ($data['email'] != $user->email) {
        $email_exists = User::where('id', '!=', $id)->where('email', $data['email'])->first();
        if (isset($email_exists)) {
            $message = 'The Email already exists';
            return $this->sendError($message, 400);
        }
        // }


        // make sure the request have all necessary input

        $validator = Validator::make($data, [

            'username' => 'required',

            'email' => 'required|email',

            'birthdate' => 'required|date',

            'isadmin' => 'sometimes|boolean',

        ]);



        //send error with bad request status if validator fail

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }


        // update user

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->birthdate = $data['birthdate'];
        $user->isadmin = $data['isadmin'];
        $result = $user->save();

        // $user['token'] =  $user->createToken('MyApp')->accessToken;

        if ($result) {
            $message = 'The User has been succesfully updated';
        } else {
            $message = 'We have encounter an error in the updating of the User';
        }

        return $this->sendResponse($user, $message, 201);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            $message = 'The User has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the User';
        }
        return $this->sendResponse($user, $message, 201);
    }
}
