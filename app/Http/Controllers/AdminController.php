<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
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
      $Admin = Admins::find($request['id']);
      $Admin->delete();
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
  public function showAdminsList(Request $request)
  {

    // $this->request = $this->reformatRequest(Request::capture()->all());
    if ($request['page']) {
      $current_page = $request['page'];
      // dd($current_page);
    } else {
      $current_page = 1;
    }
    if ($request['Adminnumber']) {
      $show_product = $request['Adminnumber'];
      // dd($show_product);
    } else {
      $show_product = 7;
    }
    $skip_product_in_page = ($current_page - 1) * $show_product;
    $Admin = Adminerators::orderBy('id', 'asc')->where('name', 'like', '%' . $request['Title'] . '%')->skip($skip_product_in_page)->take($show_product)->get();
    $AdminTotal = Adminerators::where('name', 'like', '%' . $request['Title'] . '%')->get();
    $AdminNum = count($AdminTotal);
    $resultJson = array(
      'currentPage' => $current_page,
      'AdminNumber' => count($Admin),
      'AdminMaxNumber' => $show_product,
      'totalPage' => ceil($AdminNum / $show_product),
      'result' => $Admin
    );
    return $this->createJsonResult($resultJson);
  }
}
