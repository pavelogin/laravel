<?php

namespace App\Logging\Telegram;

use Monolog\Logger;

class TelegramLoggerFactory {

    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');
        $logger->pushHandler(new TelegramLoggerHandler($config['level'], $config['token'], $config['chat_id']));
        return $logger;
    }

}
