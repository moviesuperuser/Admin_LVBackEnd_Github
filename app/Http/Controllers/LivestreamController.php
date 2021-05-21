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
  public function showLiveStreamList(){
    $LiveStreamList = Livestream::all();
    return $LiveStreamList;
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
}
