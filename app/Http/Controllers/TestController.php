<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Models\Test;

class TestController extends Controller
{
    public function listTests()
   {
      return response()->json(Test::all());
   }

   //Store a new Product in the Database.
   public function addTest(Request $req)
   {
      $test= new Test;
      $test->name = $req->input('name');
      $result=$test->save();

      return response()->json([
         'status' => (bool) $test,
         'message'=> $result ? 'The Test is successful' : 'We have encounter an error in the creation of the Test',
         $test
      ]);
   }
}
