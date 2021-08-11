<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPostSaved;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class UserPostSavedController extends BaseController
{
    public function index($page = 1, $limit = false)
    {
        $count = UserPostSaved::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $offset = ($page * $limit) - $limit;
        $games_saved = UserPostSaved::all()->skip($offset)->take($limit);
        $message = 'Request Get Games saved index successfull.';

        return $this->sendResponse([
            'games_saved' => $games_saved,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ], $message, 201);
    }

    public function getgamessaved($user_id)
    {
        $games_saved = UserPostSaved::where('user_id',"=", "$user_id")->get();
        $message = 'Request Get Games saved index successfull.';

        return $this->sendResponse([
            'games_saved' => $games_saved,
        ], $message, 201);
    }
    // public function create() {

    // }
    public function store(Request $request) {

        $data = $request->all();

        // make sure the request have all necessary input

        $validator = Validator::make($data, [
            'game_id' => 'required',

            'user_id' => 'required',
        ]);

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

   

        // register new user in database

        $game_saved = UserPostSaved::create($data);

        $message = "Game saved created !";

   

        return $this->sendResponse($game_saved,$message, 201);

    }

   

    
    public function show($id)
    {
        try {
            $game_saved = UserPostSaved::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Game saved not found', $e, 400);
        }

        $message = 'Game saved successfully found';
        return $this->sendResponse([
            'game_saved' => $game_saved,
        ], $message, 201);
    }
    // public function edit($id) {

    // }
    // public function update(Request $request, $id)
    // {
    // }

    public function destroy($id)
    {
        $game_saved = UserPostSaved::find($id);
        $result = $game_saved->delete();
        if ($result) {
            $message = 'The Game saved has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the Game saved';
        }
        return $this->sendResponse($game_saved, $message, 201);
    }
}
