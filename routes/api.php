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
    Route::post('deleteFlagComment', 'CommentsController@deleteFlagComment');
    Route::get('disableFlagAction/{IdComment}', 'CommentsController@disableFlagAction');
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

