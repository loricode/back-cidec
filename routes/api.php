<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;

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


Route::post('cidec/register', [AuthController::class, 'register']);
Route::post('/cidec/signin', [AuthController::class, 'signIn']);
Route::post('/cidec/recover', [AuthController::class, 'recoverAccount']);
//Route::post('/cidec/', [::class, ''])->middleware('auth:sanctum');
