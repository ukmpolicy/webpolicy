<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SourceController;
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

Route::post('/source/upload', [SourceController::class, 'store']);
Route::get('/source/{id}', [SourceController::class, 'show']);
Route::post('/member/{id}/change_image', [MemberController::class, 'changeImage']);

Route::post('/documentation/event', [DocumentationController::class, 'storeDocumenter'])->name('documentation.store.documenter');

Route::get('/auth/me', [AuthController::class, 'me']);


Route::get('/test', function() {
    return response()->json([
        "message" => 'Hello WOrld'
    ]);
});