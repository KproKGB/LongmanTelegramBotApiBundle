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
            // Create Telegram API object
            $telegram = new Telegram($config['bots'][$name]['token'], $name);

            // Set webhook
            if ($config['hook_url']) {
                $result = $telegram->setWebhook($config['hook_url']);
                if (!$result->isOk()) {
                    throw new TelegramException($result->getDescription());
                }
            }
        } catch (TelegramException $e) {
            // log telegram errors
            // echo $e->getMessage();
        }

        return $telegram;
    }
}
