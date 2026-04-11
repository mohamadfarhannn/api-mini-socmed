<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JWTMiddleware;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Versioning
Route::prefix('v1')->group(function () {

    // Handle Auth
    Route::Post('register', [JWTAuthController::class, 'register']);
    Route::Post('login', [JWTAuthController::class, 'login']);
    Route::middleware(JWTMiddleware::class)->get('me', [JWTAuthController::class, 'getUser']);

    // Handle route posts
    Route::middleware(JWTMiddleware::class)->prefix('posts')->group(function () {
        Route::get('/', [PostsController::class, 'index']); //mengambil semua data
        Route::get('/{id}', [PostsController::class, 'show']); //mengambil data berdasarkan id
        Route::post('/', [PostsController::class, 'store']); //menambahkan data
        Route::put('/{id}', [PostsController::class, 'update']); //mengupdate data berdasarkan id
        Route::delete('/{id}', [PostsController::class, 'destroy']); //menghapus data berdasarkan id
    });

    // Handle route comments
    Route::middleware(JWTMiddleware::class)->prefix('comments')->group(function () {
        Route::post('/', [CommentsController::class, 'store']); //menambahkan data
        Route::delete('/{id}', [CommentsController::class, 'destroy']); //menghapus data berdasarkan id
    });

    Route::middleware(JWTMiddleware::class)->prefix('likes')->group(function () {
        Route::post('/', [LikesController::class, 'store']); //Simpan like
        Route::delete('/{id}', [LikesController::class, 'destroy']); //Hapus like berdasarkan id
    });

    Route::middleware(JWTMiddleware::class)->prefix('messages')->group(function () {
        Route::get('/', [MessagesController::class, 'index']); //Tampilkan semua pesan
        Route::get('{id}', [MessagesController::class, 'show']); //Tampilkan message berdasarkan id
        Route::get('/get-by-user-id/{user_id}', [MessagesController::class, 'getMessagesByUserId']); //Tampilkan pesan masuk berdasarkan id user
        Route::post('/', [MessagesController::class, 'store']); //Simpan message
        Route::delete('{id}', [MessagesController::class, 'destroy']); //Hapus message berdasarkan id
    });
});

