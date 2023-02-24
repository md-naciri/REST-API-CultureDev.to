<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

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


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('forgotPassword','forgotPassword');
    Route::post('resetpassword','resetpassword')->name('password.reset');
    Route::middleware('auth:api')->group(function (){
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::group(['controller' => CategoryController::class ,'prefix' => 'categories'], function () {
            Route::get('', 'index')->middleware(['permission:view category']);
            Route::post('', 'store')->middleware(['permission:add category']);
            Route::get('/{category}', 'show')->middleware(['permission:view category']);
            Route::put('/{category}', 'update')->middleware(['permission:edit category']);
            Route::delete('/{category}', 'destroy')->middleware(['permission:delete category']);
        });
        Route::group(['controller' => CommentController::class ,'prefix' => 'comments'], function () {
            Route::get('', 'index')->middleware(['permission:view comment']);
            Route::post('', 'store')->middleware(['permission:add comment']);
            Route::put('/{comment}', 'update')->middleware(['permission:edit All comment|edit My comment']);
            Route::delete('/{comment}', 'destroy')->middleware(['permission:delete All comment|delete My comment']);
        });
        Route::group(['controller' => TagController::class ,'prefix' => 'tags'], function () {
            Route::get('', 'index')->middleware(['permission:view tag']);
            Route::post('', 'store')->middleware(['permission:add tag']);
            Route::get('/{tag}', 'show')->middleware(['permission:view tag']);
            Route::put('/{tag}', 'update')->middleware(['permission:edit tag']);
            Route::delete('/{tag}', 'destroy')->middleware(['permission:delete tag']);
        });
        Route::group(['controller' => ArticleController::class, 'prefix' => 'articles'], function () {
            Route::post('', 'store')->middleware(['permission:add article']);
            Route::put('/{article}', 'update')->middleware(['permission:edit All article|edit My article']);
            Route::delete('/{article}', 'destroy')->middleware(['permission:delete All article|delete My article']);
        });
        Route::group(['controller' => UserController::class, 'prefix' => 'users'], function () {
            Route::get('', 'index')->middleware(['permission:view my profil|view all profil']);
            Route::put('updateNameEmail/{user}', 'updateNameEmail')->middleware(['permission:edit my profil|edit all profil']);
            Route::put('updatePassword/{user}', 'updatePassword')->middleware(['permission:edit my profil|edit all profil']);
            Route::delete('/{user}', 'destroy')->middleware(['permission:delete my profil|delete all profil']);
        });
        // Route::apiResource('comments', CommentController::class);
        // Route::apiResource('category', CategoryController::class);
        // Route::apiResource('tags', TagController::class);
        // Route::apiResource('articles', ArticleController::class);
        // Route::apiResource('users', UserController::class);
    });
});


Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles','index');
    Route::get('/articles/{article}','show');
});
