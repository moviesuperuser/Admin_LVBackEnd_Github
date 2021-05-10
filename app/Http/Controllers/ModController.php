<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Moderators;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModController extends Controller
{
  private function createJsonResult($response)
  {
    $result = response()->json($response, 200);
    return $result
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
  }
  public function showModsList(Request $request)
  {

    // $this->request = $this->reformatRequest(Request::capture()->all());
    if ($request['page']) {
      $current_page = $request['page'];
      // dd($current_page);
    } else {
      $current_page = 1;
    }
    if ($request['modnumber']) {
      $show_product = $request['modnumber'];
      // dd($show_product);
    } else {
      $show_product = 7;
    }
    $skip_product_in_page = ($current_page - 1) * $show_product;
    $mod = Moderators::orderBy('id', 'asc')->where('name', 'like', '%' . $request['Title'] . '%')->skip($skip_product_in_page)->take($show_product)->get();
    $modTotal = Moderators::where('name', 'like', '%' . $request['Title'] . '%')->get();
    $modNum = count($modTotal);
    $resultJson = array(
      'currentPage' => $current_page,
      'modNumber' => count($mod),
      'modMaxNumber' => $show_product,
      'totalPage' => ceil($modNum / $show_product),
      'result' => $mod
    );
    return $this->createJsonResult($resultJson);
  }
}
