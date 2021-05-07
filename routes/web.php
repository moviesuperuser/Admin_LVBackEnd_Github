<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', function (Request $request) {
  // dd($request->file("thing")->store("","google"));
  // dd($request);
  $filename = $request->file("thing")->store("1GwXyun7TeMPpZO5_O9JHfvWRBEjBfOeb","google") ;
    dump($filename);
    $googleDriveStorage = Storage::disk('google');
    $dir = '/';
    $recursive = true; // Get subdirectories also?
    $file = collect(Storage::disk('google')->listContents($dir, $recursive))
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->sortBy('timestamp')
        ->last();
    dump($file);
    dump(Storage::Disk('google')->url($file['path']));
    $link = Storage::Disk('google')->url($file['path']);
    echo '<img src='.$link .' alt="Girl in a jacket">';
    // echo '<video>  <source src='. $link .' type="video/mp4"> </video>';
});
