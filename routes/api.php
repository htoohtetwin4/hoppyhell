<?php

use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('telegram/webhooks')->group(function () {

    Route::post('inbound', [TelegramController::class, 'inbound'])->name('telegram.inbound');
});
Route::get('getupdate', [TelegramController::class, 'getUpdates']);

// https://api.telegram.org/bot7128413180:AAFO1c33eFD55BN9PuyCRjd8SeMi-uvf8Pk/setWebhook?url=https://69c4-49-237-46-128.ngrok-free.app/api/telegram/webhooks/inbound