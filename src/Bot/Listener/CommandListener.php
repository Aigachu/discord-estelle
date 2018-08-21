<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Listener;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class CommandListener
 * @package Aigachu\Lavenza\Bot\Listener\CommandListener
 */
final class CommandListener extends ListenerBase
{

    // Get the bot this listener is working for.
    protected $bot;

    // Get the bot this listener is working for.
    protected $client;

    /**
     * CommandListener constructor.
     * @param $bot
     * @param $client
     */
    public function __construct($bot, $client)
    {
        $this->bot = $bot;
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function listen($content)
    {

    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }
}