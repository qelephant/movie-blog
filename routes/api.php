<?php

use App\Http\Controllers\{AuthController, ReviewController, ActorController, MovieController, CountryController};
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('v1')->group(function () {
    Route::apiResource('review', ReviewController::class);
    Route::apiResource('actor', ActorController::class);
    Route::apiResource('movie', MovieController::class);
    Route::apiResource('country', CountryController::class);


});
