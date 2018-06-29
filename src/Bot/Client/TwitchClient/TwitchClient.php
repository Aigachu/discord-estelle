<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Client\TwitchClient;

use Aigachu\Lavenza\Bot\BotInterface;
use Aigachu\Lavenza\Bot\Client\ClientInterface;

class TwitchClient implements ClientInterface
{
    /**
     * LavenzaClient constructor.
     * @param BotInterface $bot
     * @param array $options
     */
    function __construct(BotInterface $bot, array $options = array())
    {
        // TODO: Implement __construct() method.
    }

    public function authenticate()
    {
        // TODO: Implement authenticate() method.
    }

    public function reply($message, $text)
    {
        // TODO: Implement reply() method.
    }
}