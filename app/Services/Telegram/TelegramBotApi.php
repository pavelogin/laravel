<?php

namespace App\Services\Telegram;

use App\Services\Telegram\Exceptions\TelegramBotApiException;
use Illuminate\Support\Facades\Http;

class TelegramBotApi
{

    public const HOST = 'https://api.telegram.org/bot333';

    /**
     * @throws TelegramBotApiException
     */
    public static function sendMessage(string $token, int $chatId, string $text): bool
    {
        $isSendMessage = false;
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', ['chat_id' => $chatId, 'text' => $text])
                ->throw()
                ->json();

            $isSendMessage = $response['ok'] ?? false;
        } catch (\Throwable $e) {
            report(throw new TelegramBotApiException($e->getMessage()));

            //TODO если вылетит исключение в этом не будет ни какого смысла
            $isSendMessage = false;
        }

        return $isSendMessage;
    }

}
