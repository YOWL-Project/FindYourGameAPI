<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTopicSaved;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class UserTopicSavedController extends BaseController
{
    public function index($page = 1, $limit = false)
    {
        $count = UserTopicSaved::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $offset = ($page * $limit) - $limit;
        $topics_saved = UserTopicSaved::all()->skip($offset)->take($limit);
        $message = 'Request Get Topics saved index successfull.';

        return $this->sendResponse([
            'topics_saved' => $topics_saved,
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
            'topic_id' => 'required',

            'user_id' => 'required',
        ]);

        //send error with bad request status if validator fail

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors(), 400);       

        }

   

        // register new user in database

        $topic_saved = UserTopicSaved::create($data);

        $message = "Topic saved created !";

   

        return $this->sendResponse($topic_saved,$message, 201);

    }

   

    
    public function show($id)
    {
        try {
            $topic_saved = UserTopicSaved::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Topic saved not found', $e, 400);
        }

        $message = 'Topic saved successfully found';
        return $this->sendResponse([
            'topic_saved' => $topic_saved,
        ], $message, 201);
    }
    // public function edit($id) {

    // }
    // public function update(Request $request, $id)
    // {
    // }

    public function destroy($id)
    {
        $topic_saved = UserTopicSaved::find($id);
        $result = $topic_saved->delete();
        if ($result) {
            $message = 'The Topic saved has been succesfully delete';
        } else {
            $message = 'We have encounter an error in the deleting of the Topic saved';
        }
        return $this->sendResponse($topic_saved, $message, 201);
    }
}
