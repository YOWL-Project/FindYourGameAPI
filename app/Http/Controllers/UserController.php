<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;

class UserController extends BaseController
{
    public function index($page = 1, $limit = false) {
        $offset = ($page * $limit) - $limit;
        $count = User::all()->count();
        if ($limit == false) {
            $limit = $count;
        }
        $users = User::all()->skip($offset)->take($limit);
        // dd($users);
        $message = 'Request Get User index successfull.';

        return $this->sendResponse([
            'users' => $users,
            'count' => $count,
            'limit' => $limit,
            'page' => $page,
        ],$message, 201);
    }
    // public function create() {

    // }
    // public function store() {
        
    // }
    public function show() {
        
    }
    public function edit() {
        
    }
    public function update() {
        
    }
    public function destroy() {
        
    }
}
