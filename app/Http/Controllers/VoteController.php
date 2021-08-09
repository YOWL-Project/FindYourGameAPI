<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(Request $request)
    {
        $votes = Vote::orderBy('vote_date', 'asc')->get();
        return response()->json($votes);
    }
}


