<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
  public function disableFlagAction(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'IdComment' => 'required|numeric',
        'IdUser'    => 'required|numeric'
      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    $action_check = (array)DB::table('Flag_action')
      ->where('IdComment', $request['IdComment'])
      ->where('IdUSer', $request['IdUser'])
      ->select('IdComment')
      ->first();
    if (count($action_check) == 1) {
      $action_Comment_check = DB::table('Flag_action')
        ->where('IdComment', $request['IdComment'])
        ->where('IdUser', $request['IdUser'])
        ->delete();
      $IdComment = $request['IdComment'];
      $Update_FLag_Comment = DB::update('UPDATE Comments SET Flag = 0 where id=' . $IdComment);
      return response()->json(
        "Successfull",
        200
      );
    } else {
      return response()->json(
        "Error!",
        422
      );
    }
  }
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
