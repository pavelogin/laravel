<?php

namespace App\Logging\Telegram;

use App\Services\Telegram\TelegramBotApi;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class TelegramLoggerHandler extends AbstractProcessingHandler {

    protected int $chatId;

    protected string $token;

    public function __construct(string $level, string $token, string $chatId) {
        $level = Logger::toMonologLevel($level);

        parent::__construct($level);

        $this->token = $token;
        $this->chatId = $chatId;
    }

    protected function write(array $record): void {
        TelegramBotApi::sendMessage($this->token, $this->chatId, $record['formatted']);
    }

}
