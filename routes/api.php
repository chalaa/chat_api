<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfilePictureController;
use App\Models\UserProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->group(function(){
    Route::get('/',[UserController::class,'index']);
    Route::get('/{id}',[UserController::class,'show']);
    Route::post('/',[UserController::class,'store']);
    Route::put('/{id}',[UserController::class,'update']);
    Route::post('/profile/{id}',[UserProfilePictureController::class,'store']);
});
Route::get('/chat',[ChatController::class,'index']);
Route::get('/chat/{id}',[ChatController::class,'show']);
Route::post('/chat',[ChatController::class,'store']);
Route::delete('/chat/{id}/{id2}',[ChatController::class,'destroy']);

