<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotePost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class VotePostController extends BaseController
{
    public function index($page = 1, $limit = false)
    {
        $count = VotePost::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $offset = ($page * $limit) - $limit;
        $votes = VotePost::all()->skip($offset)->take($limit);
        $message = 'Request Get Vote index successfull.';

        return $this->sendResponse([
            'votes' => $votes,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
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

            'vote' => 'required|integer|between:-1,1|not_in:0',
        ]);

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

   

        // register new user in database

        $vote = VotePost::create($data);

        $message = "Vote created !";

   

        return $this->sendResponse($vote,$message, 201);

    }

   

    
    public function show($id)
    {
        try {
            $vote = VotePost::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Vote not found', $e, 400);
        }

        $message = 'Vote successfully found';
        return $this->sendResponse([
            'vote' => $vote,
        ], $message, 201);
    }
    // public function edit($id) {

    // }
    public function update(Request $request, $id)
    {

        $vote = VotePost::find($id);
        $data = $request->all();
        // make sure the request have all necessary input

        $validator = Validator::make($data, [
            'game_id' => 'required',

            'user_id' => 'required',

            'vote' => 'required|integer|between:-1,1|not_in:0',
        ]);

        //send error with bad request status if validator fail

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        // update topic

        $vote->game_id = $data['game_id'];
        $vote->user_id = $data['user_id'];
        $vote->vote = $data['vote'];
        $result = $vote->save();

        if ($result) {
            $message = 'The Vote has been succesfully updated';
        } else {
            $message = 'We have encounter an error in the updating of the Vote';
        }

        return $this->sendResponse($vote, $message, 201);

    }

    public function destroy($id)
    {
        $vote = VotePost::find($id);
        $result = $vote->delete();
        if ($result) {
            $message = 'The Vote has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the Vote';
        }
        return $this->sendResponse($vote, $message, 201);
    }
}
