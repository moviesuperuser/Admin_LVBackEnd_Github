<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
  private function createJsonResult($response)
  {
    $result = response()->json($response, 200);
    return $result
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  }
  public function showCommentFlagList()
  {
    $commentList = DB::table('Comments')
      ->where('Flag', 1)
      ->select('*')
      ->get();
    return $this->createJsonResult($commentList);
  }
  public function deleteFlagComment(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'IdComment'     => 'required|numeric'
      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    $action_Comment_delete = DB::table('Comments')
      ->where('id', $request['IdComment'])
      ->delete();
    $action_Comment_delete_children = DB::table('Comments')
      ->where('IdParentUser', $request['IdComment'])
      ->delete();
    return "Successful";
  }
}
