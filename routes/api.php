<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
URL::forceScheme('https');

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/
Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'auth',
  ],
  function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('delete', 'AuthController@delete')->name('delete');
    Route::get('downgrade', 'AuthController@downgrade')->name('downgrade');
 }
);
Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'mod',
  ],
  function ($router) {
    Route::get('showModsList', 'ModController@showModsList')->name('showModsList');
  }
);
Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'comment',
  ],
  function ($router) {
    Route::get('showCommentFlagList', 'CommentsController@showCommentFlagList');
    Route::get('deleteFlagComment/{IdComment}', 'CommentsController@deleteFlagComment');
    Route::post('disableFlagAction', 'CommentsController@disableFlagAction');
    // Route::get('showCommentsUserDisLike', 'CommentsController@showCommentsUserDisLike');
  }
);
Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'admin',
  ],
  function ($router) {
    Route::get('showAdminsList', 'AdminController@showAdminsList')->name('showAdminsList');
    Route::get('delete', 'AdminController@delete')->name('delete');
  }
);
Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'user',
  ],
  function ($router) {
    Route::get('showUsersList', 'UserController@showUsersList')->name('showUsersList');
    Route::get('delete', 'UserController@delete')->name('delete');
    Route::post('banUser', 'UserController@BanUser')->name('banUser');
  }
);

Route::group(
  [
    'middleware' => 'api',
    'namespace'  => 'App\Http\Controllers',
    'prefix'     => 'livestream',
  ],
  function ($router) {
    Route::get('showLiveStreamList', 'LivestreamController@showLiveStreamList')->name('showLiveStreamList');
    Route::post('addLivestream', 'LivestreamController@addLivestream')->name('addLivestream');
    Route::post('editLivestream', 'LivestreamController@editLivestream')->name('editLivestream');
    Route::get('deleteLivestream/{LivestreamId}', 'LivestreamController@deleteLivestream')->name('deleteLivestream');
  }
);

