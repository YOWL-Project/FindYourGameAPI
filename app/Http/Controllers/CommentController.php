<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class CommentController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index () {
        $comments = Comment::all();
        return response()->json($comments);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show ($id) {
        $comment = Comment::findOrFail($id);

        if($comment) {
            //return response()->json($comment);
            $message = 'Comment successfully found';
            return $this->sendResponse([
                'comment' => $comment,
            ], $message, 200);
        }
        else {
            return $this->sendError('Comment not found', 404);
            //return response()->json(["status" => "error"]);
        }        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store (Request $request) {
        $content = $request->input('content');
        //$user = (lier le commentaire crée à l'user)

        if($content) {
            $validatedData = $request->validate([
                'topic_id' => 'required',
                'user_id' => 'required',
                'content' => 'required'
            ]);


        
            $comment = Comment::create($validatedData);

            $message = 'Your comment have been posted';
            return $this->sendResponse([
            'comment' => $comment,
            ], $message, 201);
            //return response()->json(["status" => "success"]);
        }
        else {
            return $this->sendError('Something went wrong', 400);
            // return response()->json(["status" => "error"]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
     
    public function update (Request $request, $id) {
        $comment = Comment::findOrFail($id);

        if ($comment) {
            $validatedData = $request->validate([
                'topic_id' => 'required',
                'user_id' => 'required',
                'content' => 'required'
            ]);

            $commentupdated = Comment::whereId($id)->update($validatedData);

            $message = 'Your comment have been updated';
            return $this->sendResponse([
            'comment' => $commentupdated,
            ], $message, 201);

            // return response()->json(["status" => "success"]);

        }
        else {
            return $this->sendError('Something went wrong', 400);
            // return response()->json(["status" => "error"]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy ($id) {
        $comment = Comment::findOrFail($id);
        if($comment) {
            $comment->delete();
            $message = 'Comment successfully deleted';
            return $this->sendResponse($message, 200);
            // return response()->json(["status" => "success"]);
        }
        else {
            return $this->sendError('Something went wrong', 400);
            // return response()->json(["status" => "error"]);
        }
    }
}
