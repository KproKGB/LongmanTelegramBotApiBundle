<?php

namespace KproKGB\LongmanTelegramBotApiBundle\Service;

use KproKGB\LongmanTelegramBotApiBundle\DependencyInjection\Factory\BotFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Bot
{
    private $config;

    public function __construct(ContainerInterface $container)
    {
        $this->config = $container->getParameter('longman_telegram_bot_api.config');
    }

    public function getBot($name = null)
    {
        $factory = new BotFactory();

        if($name == null) {
            if($this->config['default']) {
                return $factory->create($this->config, $this->config['default']);
            } else {
                return $factory->create($this->config, reset($this->config['bots']));
            }
        }

        return $factory->create($this->config, $name);
    }
}
