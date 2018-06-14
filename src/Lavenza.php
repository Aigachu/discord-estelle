<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza;

use Aigachu\Lavenza\Client\LavenzaClient;

/**
 * Class Lavenza
 * Lavenza's core. This class will house the core functionality of the bot.
 *
 * @package Aigachu\Lavenza
 */
class Lavenza
{
    /**
     * The version of Lavenza.
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * Discord clients that Lavenza will use.
     * @var array $clients
     */
    protected $clients;

    /**
     * Lavenza constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->clients = [
            new LavenzaClient($config['clients']['lavenza']['token'], []),
        ];
    }

    /**
     * Lavenza Jack In function.
     * Login to the Discord server with all of Lavenza's bot clients.
     */
    public function jackIn() {
        foreach ($this->clients as $client) {
            /**
             * @var LavenzaClient $client
             */
            $client->clientLogin();
        }
    }
}