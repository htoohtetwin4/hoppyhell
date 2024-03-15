<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function inbound(Request $request)
    {
        Log::info($request->all());
        $data = $request->all();
        if (isset($data['message']) && isset($data['message']['text'])) {
            Log::info("yes");
            $message = $data['message']['text'];
            if ($message == '/ano') {
                $chat_id = $data['message']['chat']['id'];
                $reply = "Bat God Landing will be Soon !";

                $content = ['chat_id' => $chat_id, 'text' => $reply];
                $this->sendMessage($content);
            } else if ($message == '/Start') {
                $chat_id = $data['message']['chat']['id'];
                $reply = "Well,Well Well - The Scariest things in the world would be HUMAN,Why not find it out yourself through out the Story";
                $keyboard = [
                    'keyboard' => [
                        [['text' => ''], ['text' => 'Dr ll 2 2 pl']]
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true
                ];
                $optionsKB = json_encode($keyboard);
                $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
                $this->sendMessage($content);
            }
        }
        return response()->json();
    }
    public function sendMessage($content)
    {
        Log::info($content);
        if (isset($content['reply_markup'])) {
            $response = Http::post('https://api.telegram.org/bot' . env("TELEGRAM_BOT_TOKEN") . '/sendMessage', ['chat_id' => $content['chat_id'], 'text' => $content['text'], 'reply_markup' => $content['reply_markup']]);
        } else {
            $response = Http::post('https://api.telegram.org/bot' . env("TELEGRAM_BOT_TOKEN") . '/sendMessage', ['chat_id' => $content['chat_id'], 'text' => $content['text']]);
        }

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Failed to send message'], $response->status());
        }
        return response()->json();
    }



    public function setupWebhook()
    {
        $response = Http::post('https://api.telegram.org/bot' . '7128413180:AAFO1c33eFD55BN9PuyCRjd8SeMi-uvf8Pk' . '/setWebhook', [
            'url' => 'https://59cd-124-121-134-158.ngrok-free.app/webhook'
        ]);

        if ($response->successful()) {
            return $response;
        } else {
            return response()->json(['error' => 'Failed to set up webhook'], $response->status());
        }
    }
}
