<?php

namespace KproKGB\LongmanTelegramBotApiBundle\DependencyInjection\Factory;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class BotFactory
{
    /**
     * @param array $config
     * @param string $name
     * @return Telegram
     */
    public function create(array $config = [], string $name)
    {
        try {
            $botConfig = $config['bots'][$name];

            // Create Telegram API object
            $telegram = new Telegram($botConfig['token'], $name);
            $telegram->useGetUpdatesWithoutDatabase($botConfig['without_db']);

            // Set webhook
            if ($botConfig['hook_url']) {
                $result = $telegram->setWebhook($botConfig['hook_url']);
                if (!$result->isOk()) {
                    throw new TelegramException($result->getDescription());
                }
            }
        } catch (TelegramException $e) {
            throw new \RuntimeException($e);
        }

        return $telegram;
    }
}
