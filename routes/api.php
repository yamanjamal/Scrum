<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\maneger\CommentController;
use App\Http\Controllers\maneger\ProjectController;
use App\Http\Controllers\maneger\RequirmentController;
use App\Http\Controllers\maneger\SrsController;
use App\Http\Controllers\maneger\TaskController;
use App\Http\Controllers\maneger\UserController;
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
// +++++++++++++++++++++++++++++++start Project api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'Project'], function() {
        Route::get('index',               [ProjectController::class,'index']);
        Route::post('/search',             [ProjectController::class,'search']);
        Route::get('/show/{project}',      [ProjectController::class,'show' ]); 
        Route::post('/store',              [ProjectController::class,'store']);
        Route::post('/assign/{project}',   [ProjectController::class,'assign']);
        Route::put('/update/{project}',    [ProjectController::class,'update']);
        Route::delete('/destroy/{project}',[ProjectController::class,'destroy']);
    });
    // +++++++++++++++++++++++++++++++end Project api+++++++++++++++++++++++++++++++++++


Route::group(['middleware'=>'auth:sanctum'], function() {

    // +++++++++++++++++++++++++++++++start Project api+++++++++++++++++++++++++++++++++++
    // Route::group(['prefix' => 'Project'], function() {
    //     Route::get('/index',               [ProjectController::class,'index']);
    //     Route::post('/search',             [ProjectController::class,'search']);
    //     Route::get('/show/{project}',      [ProjectController::class,'show' ]); 
    //     Route::post('/store',              [ProjectController::class,'store']);
    //     Route::post('/assign/{project}',   [ProjectController::class,'assign']);
    //     Route::put('/update/{project}',    [ProjectController::class,'update']);
    //     Route::delete('/destroy/{project}',[ProjectController::class,'destroy']);
    // });
    // +++++++++++++++++++++++++++++++end Project api+++++++++++++++++++++++++++++++++++
    

    // +++++++++++++++++++++++++++++++start Requirment api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'Requirment'], function() {
        // Route::get('/index',                  [RequirmentController::class,'index']);
        Route::get('/show/{requirment}',      [RequirmentController::class,'show' ]); 
        Route::post('/store',                 [RequirmentController::class,'store']);
        Route::put('/update/{requirment}',    [RequirmentController::class,'update']);
        Route::delete('/destroy/{requirment}',[RequirmentController::class,'destroy']);
    });
    // +++++++++++++++++++++++++++++++end Requirment api+++++++++++++++++++++++++++++++++++

    // +++++++++++++++++++++++++++++++start Srs api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'Srs'], function() {
        // Route::get('/index',           [SrsController::class,'index']);
        Route::get('/show/{srs}',      [SrsController::class,'show' ]); 
        Route::post('/store',          [SrsController::class,'store']);
        Route::delete('/destroy/{srs}',[SrsController::class,'destroy']);
    });
    // +++++++++++++++++++++++++++++++end Srs api+++++++++++++++++++++++++++++++++++
     
    // +++++++++++++++++++++++++++++++start Task api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'Task'], function() {
        // Route::get('/index',            [TaskController::class,'index']);
        Route::get('/show/{task}',      [TaskController::class,'show' ]); 
        Route::post('/store',           [TaskController::class,'store']);
        Route::put('/update/{task}',    [TaskController::class,'update']);
        Route::post('/assign/{task}',   [TaskController::class,'assign']);
        Route::delete('/destroy/{task}',[TaskController::class,'destroy']);
    });
    // +++++++++++++++++++++++++++++++end Task api+++++++++++++++++++++++++++++++++++    
    
    // +++++++++++++++++++++++++++++++start Comment api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'Comment'], function() {
        Route::post('/store',              [CommentController::class,'store']);
        Route::delete('/destroy/{comment}',[CommentController::class,'destroy']);
    });
    // +++++++++++++++++++++++++++++++end Comment api+++++++++++++++++++++++++++++++++++

    // +++++++++++++++++++++++++++++++start User api+++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'User'], function() {
        Route::get('/index',            [UserController::class,'index']);
        Route::get('/count',            [UserController::class,'count']);
        Route::delete('/destroy/{user}',[UserController::class,'destroy']);
        // Route::post('/register',        [RegisterController::class,'register']);
        Route::get('/logout',           [RegisterController::class,'logout']);
        Route::get('/info', function    (Request $request) {return $request->user();});
    });
    // +++++++++++++++++++++++++++++++end User api+++++++++++++++++++++++++++++++++++
});

Route::post('/User/register',        [RegisterController::class,'register']);

Route::post('/login',           [RegisterController::class,'login']);
