<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class TopicController extends BaseController
{
    public function index($page = 1, $limit = false)
    {
        $offset = ($page * $limit) - $limit;
        $count = Topic::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $topics = Topic::all()->skip($offset)->take($limit);
        $message = 'Request Get Topic index successfull.';

        return $this->sendResponse([
            'topics' => $topics,
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

            'title' => 'required',

        ]);

   

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

   

        // register new user in database

        $topic = Topic::create($data);

        $message = "Topic created !";

   

        return $this->sendResponse($topic,$message, 201);

    }

   

    
    public function show($id)
    {
        try {
            $topic = Topic::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Topic not found', $e, 400);
        }

        $message = 'Topic successfully found';
        return $this->sendResponse([
            'topic' => $topic,
        ], $message, 201);
    }
    // public function edit($id) {

    // }
    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $data = $request->all();
        // make sure the request have all necessary input

        $validator = Validator::make($data, [

            'game_id' => 'required',

            'user_id' => 'required',

            'title' => 'required',
        ]);

        //send error with bad request status if validator fail

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        // update topic

        $topic->game_id = $data['game_id'];
        $topic->user_id = $data['user_id'];
        $topic->title = $data['title'];
        $result = $topic->save();

        if ($result) {
            $message = 'The Topic has been succesfully updated';
        } else {
            $message = 'We have encounter an error in the updating of the Topic';
        }

        return $this->sendResponse($topic, $message, 201);
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        $result = $topic->delete();
        if ($result) {
            $message = 'The Topic has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the Topic';
        }
        return $this->sendResponse($topic, $message, 201);
    }
}
