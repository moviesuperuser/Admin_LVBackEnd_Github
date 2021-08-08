<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Recombee\RecommApi\Client;

use Recombee\RecommApi\Requests as Reqs;

class UserController extends Controller
{
  public function delete(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        "id" => 'required|numeric',
        "confirm" => 'required|boolean'
      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    if ($request['confirm']) {
      $User = User::find($request['id']);
      $User->delete();
      $client = new Client("movies202-dev", 'JPhrE3mFxojlFRbEaxzQNQFubp9h73V8h3JtRokprr5Kd3b7uE8O54ZpZOwHB0oT');
      $requestRecombee =  new Reqs\DeleteUser($request['id']);
      $client->send($requestRecombee);
      return "successful";
    }
  }
  private function createJsonResult($response)
  {
    $result = response()->json($response, 200);
    return $result
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  }
  public function showUsersList(Request $request)
  {
    // $this->request = $this->reformatRequest(Request::capture()->all());
    if ($request['page']) {
      $current_page = $request['page'];
    } else {
      $current_page = 1;
    }
    if ($request['Usernumber']) {
      $show_product = $request['Usernumber'];
      // dd($show_product);
    } else {
      $show_product = 20;
    }
    $skip_product_in_page = ($current_page - 1) * $show_product;
    $User = User::orderBy('id', 'desc')->where('name', 'like', '%' . $request['Title'] . '%')->skip($skip_product_in_page)->take($show_product)->get();
    $UserTotal = User::where('name', 'like', '%' . $request['Title'] . '%')->get();
    $UserNum = count($UserTotal);
    $resultJson = array(
      'currentPage' => $current_page,
      'UserNumber' => count($User),
      'UserMaxNumber' => $show_product,
      'totalPage' => ceil($UserNum / $show_product),
      'result' => $User
    );
    return $this->createJsonResult($resultJson);
  }
  public function BanUser(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        "UserId" => 'required|numeric'
      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    $user = User::find($request['UserId']);
    if (!isset($user)) {
      return response()->json(
        "User not found.",
        404
      );
    } else {
      $banExpired = $user['BAN_expired'];
      $nowTime = Carbon::now('UTC');
      if ($nowTime->lessThan($banExpired)) {
        return response()->json(
          "User đã bị ban.",
          200
        );
      } else {
        $bannedNum = $user['Banned'];
        if ($bannedNum <= 3) {
          $user->BAN_expired = Carbon::now('UTC')->addHours(1);
          $user->Banned = $bannedNum + 1;
          $user->save();
          return response()->json(
            "User " . $user['name'] . " đã bị ban trong 1h.",
            200
          );
        } elseif ($bannedNum <= 5) {
          $user['BAN_expired'] = Carbon::now('UTC')->addDays(1);
          $user['Banned'] = $bannedNum + 1;
          $user->save();
          return response()->json(
            "User " . $user['name'] . " đã bị ban trong 1 ngày.",
            200
          );
        } elseif ($bannedNum <= 7) {
          $user['BAN_expired'] = Carbon::now('UTC')->addDays(7);
          $user['Banned'] = $bannedNum + 1;
          $user->save();
          return response()->json(
            "User " . $user['name'] . " đã bị ban trong 7 ngày.",
            200
          );
        } elseif ($bannedNum > 7) {
          $user['BAN_expired'] = Carbon::now('UTC')->addYears(100);
          $user['Banned'] = $bannedNum + 1;
          $user->save();
          return response()->json(
            "User " . $user['name'] . " đã bị ban vĩnh viễn.",
            200
          );
        }
      }
    }
  }
}
