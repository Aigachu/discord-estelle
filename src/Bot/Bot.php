<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

use Aigachu\Lavenza\Client\ClientInterface;
use Aigachu\Lavenza\Client\ClientFactory;

/**
 * Class Bot
 * @package Aigachu\Lavenza\Bot
 */
class Bot implements BotInterface
{
    /**
     * Identification of the bot obtained from configurations.
     * This ID will be used for personifications down the line.
     * @var string $id
     */
    public $id;

    /**
     * Clients that Lavenza will use.
     * i.e. Discord, Twitch, Youtube, Skype (LMAO JK!!! GROSS), etc!
     * @var array $clients
     */
    protected $clients;

    /**
     * Configuration array claimed from the config.yml file at the root of the project.
     * Follow the instructions in that file to get Lavenza to run properly.
     * A token must be configured for each client that is supposed to run.
     * @var array $config
     */
    protected $config;

    /**
     * Bot constructor.
     * @param $id
     * @param $config
     */
    public function __construct($id, $config)
    {
        $this->id = $id;
        $this->config = $config;
        foreach ($this->config['clients'] as $client_type => $client_config) {
            $this->clients[$client_type] = ClientFactory::instantiate($client_type, $this);
        }
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Lavenza Jack In function.
     * Login to the Discord server with all of Lavenza's bot clients.
     */
    public function summon(): bool {

        foreach ($this->clients as $client) {
            /**
             * @var ClientInterface $client
             */
            $client->authenticate();
        }

        return true;
    }
}