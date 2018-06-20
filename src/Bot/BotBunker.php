<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

use Aigachu\Lavenza\Configuration\ConfigRepository;

/**
 * Class BotBunker
 * @package Aigachu\Lavenza\Bot
 */
final class BotBunker
{
    /**
     * Lavenza constructor.
     */
    public static function deploy()
    {
        // Fetch bots configuration from yml files.
        $bots_config = ConfigRepository::config('bots');

        // Instantiate and authenticate all of the bots.
        foreach ($bots_config as $bot_id => $bot_config) {
            $bot = new Bot($bot_id, $bot_config);
            $bot->summon();
        }
    }
}