<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

/**
 * Class LavenzaBot
 * @package Aigachu\Lavenza\Bot
 */
class LavenzaBot extends BotBase
{
    /**
     * The version of Lavenza.
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * The simple identification of the bot to be used in the application.
     * @var string
     */
    const ID = 'lavenza';

    /**
     * LavenzaBot constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->clients = [
            ClientFactory::instantiate('discord', $this),
            // ClientFactory::instantiate('twitch', $this),
            // ClientFactory::instantiate('youtube', $this),
        ];
    }
}