<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Inventory;
use App\Models\Item;
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
            $message = $data['message']['text'];
            if ($message == '/start') {
                $this->handleStartScenario($data);
            } else if ($message == 'Ivan') {
                $this->handleIvanScenario($data);
            } else if ($message == 'Pocket-knife') {
                $this->handlePocketKnifeScenario($data);
            } else if ($message == 'Flashlight') {
                $this->handleFlashLightScenario($data);
            } else if ($message == 'Ready') {
                $this->handleStoryScenario($data);
            } else if ($message == 'Call Vic') {
                $this->handleStoryWithVacScenario($data);
            } else if ($message == 'Call Ral') {
                $this->handleStoryWithRalScenario($data);
            } else if ($message == 'Going to the Gather') {
                $this->handleStoryPartTwo($data);
            } else if ($message == 'Coming Soon....') {
                $this->handleFinalPhoto($data);
            }
        }
        return response()->json();
    }

    public function handleStartScenario($data)
    {
        $chat_id = $data['message']['chat']['id'];
        $reply = "Well, Well, Well - The scariest things in the world would be HUMAN, why not find it out yourself through our story. You are ...!";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Ivan']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
        return response()->json();
    }

    public function handleIvanScenario($data)
    {
        $chat_id = $data['message']['chat']['id'];
        $reply = "Ivan is packing his fully loaded backpack and still thinking what he will pick for the last item";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Flashlight'], ['text' => 'Pocket-knife']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
        return response()->json();
    }

    public function handleFlashLightScenario($data)
    {
        Log::info("flashlight stage");
        $chat_id = $data['message']['chat']['id'];
        $character = Character::where('name', 'Ivan')->first();
        $item = Item::where('name', 'Flashlight')->first();

        $existingInventory = Inventory::where('character_id', $character->id)
            ->where('item_id', $item->id)
            ->first();

        if ($existingInventory) {
            $reply = "You already has the Flashlight and is ready for the trip!";
        } else {
            Inventory::create([
                'character_id' => $character->id,
                'item_id' => $item->id,
            ]);

            $reply = "You successfully picked up the Flashlight and is now ready for the trip!";
        }

        $keyboard = [
            'keyboard' => [
                [['text' => "Ready"]]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];

        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);

        return response()->json();
    }

    public function handlePocketKnifeScenario($data)
    {
        Log::info("pocket-knife stage");
        $chat_id = $data['message']['chat']['id'];
        $character = Character::where('name', 'Ivan')->first();
        $item = Item::where('name', 'Pocket-knife')->first();

        $existingInventory = Inventory::where('character_id', $character->id)
            ->where('item_id', $item->id)
            ->first();

        if ($existingInventory) {
            $reply = "You already has the pocket-knife and is ready for the trip!";
        } else {
            Inventory::create([
                'character_id' => $character->id,
                'item_id' => $item->id,
            ]);

            $reply = "You successfully picked up the pocket-knife and is now ready for the trip!";
        }

        $keyboard = [
            'keyboard' => [
                [['text' => "Ready"]]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];

        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);

        return response()->json();
    }

    public function handleStoryScenario($data)
    {
        Log::info('Story Stage');
        $chat_id = $data['message']['chat']['id'];
        $reply = "Before everything starts, I would like you to know that everything can happen depending on your choices. It's like the butterfly effect.";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Call Vic'], ['text' => 'Call Ral']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
        return response()->json();
    }
    public function handleStoryWithVacScenario($data)
    {
        Log::info('Partner - Vic');
        $chat_id = $data['message']['chat']['id'];
        $reply = "Beep! Beep!!! Beep! What took you so long? Smant will be mad if we're late. Grab your things and let's go!";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Going to the Gather']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
        return response()->json();
    }
    public function handleStoryWithRalScenario($data)
    {
        Log::info('Partner - Ral');
        $chat_id = $data['message']['chat']['id'];
        $reply = "Beep! Beep!!! Beep! What took you so long? Smant will be mad if we're late. Grab your things and let's go!";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Going to the Gather']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
        return response()->json();
    }
    public function handleStoryPartTwo($data)
    {
        Log::info('Part Two');
        $chat_id = $data['message']['chat']['id'];
        $reply = "Beep! Beep!!! Beep! What took you so long? Smant will be mad if we're late. Grab your things and let's go!";
        $keyboard = [
            'keyboard' => [
                [['text' => 'Coming Soon....']]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];
        $optionsKB = json_encode($keyboard);
        $content = ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $optionsKB];
        $this->sendMessage($content);
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
    public function sendMessage($content)
    {
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
}
