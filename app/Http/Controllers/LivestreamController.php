<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Livestream;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LivestreamController extends Controller
{
  public function showLiveStreamList(Request $request){
    // $LiveStreamList = Livestream::all();
    // return $LiveStreamList;

     // $this->request = $this->reformatRequest(Request::capture()->all());
     if ($request['page']) {
      $current_page = $request['page'];
      // dd($current_page);
    } else {
      $current_page = 1;
    }
    if ($request['Livestreamnumber']) {
      $show_product = $request['Livestreamnumber'];
      // dd($show_product);
    } else {
      $show_product = 7;
    }
    $skip_product_in_page = ($current_page - 1) * $show_product;
    $Livestream = Livestream::orderBy('id', 'asc')->where('Title', 'like', '%' . $request['Title'] . '%')->skip($skip_product_in_page)->take($show_product)->get();
    $LivestreamTotal = Livestream::where('Title', 'like', '%' . $request['Title'] . '%')->get();
    $LivestreamNum = count($LivestreamTotal);
    $resultJson = array(
      'currentPage' => $current_page,
      'LivestreamNumber' => count($Livestream),
      'LivestreamMaxNumber' => $show_product,
      'totalPage' => ceil($LivestreamNum / $show_product),
      'result' => $Livestream
    );
    return $this->createJsonResult($resultJson);
  }
  public function addLivestream(Request $request){
    $validator = Validator::make(
      $request->all(),
      [
        "Title" => 'required|string',
        "Link" => 'required|string',
        "Start_time" => 'required|date',
        "Genres" => 'required|string',

      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    $Livestream = new Livestream();
    $Livestream->Title = $request->Title;
    $Livestream->Link = $request->Link;
    $Livestream->Start_time = $request->Start_time;
    $Livestream->Genres = $request->Genres;
    $Livestream->save();
    return "Successful";
  }
  public function editLivestream(Request $request){
    $validator = Validator::make(
      $request->all(),
      [
        "LivestreamId"=> 'required|numeric',
        "Title" => 'required|string',
        "Link" => 'required|string',
        "Start_time" => 'required|date',
        "Genres" => 'required|string',

      ]
    );
    if ($validator->fails()) {
      return response()->json(
        [$validator->errors()],
        422
      );
    }
    $Livestream = Livestream::find($request->LivestreamId);
    $Livestream->Title = $request->Title;
    $Livestream->Link = $request->Link;
    $Livestream->Start_time = $request->Start_time;
    $Livestream->Genres = $request->Genres;
    $Livestream->save();
    return "Successful";
  }
  public function deleteLivestream($LivestreamId){
    $Livestream = Livestream::find($LivestreamId);
    $Livestream->delete();
    return "Successful";
  }
}
