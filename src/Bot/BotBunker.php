<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

use Aigachu\Lavenza\Lavenza;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class BotBunker
 *
 * @package Aigachu\Lavenza\Bot
 */
final class BotBunker
{

    /**
     * @var array $bots
     */
    private static $bots = [];

    use SingletonTrait;

    /**
     * @return array
     */
    public function getBots() : array
    {
        return self::$bots;
    }

    /**
     * Lavenza constructor.
     *
     * @param array $ids Bot IDs that should be deployed. If empty, all bots
     *                   are deployed.
     *
     * @return bool
     */
    public static function deployBots(array $ids = []) : bool
    {
        // Check if the configuration for bots is empty.
        if (empty(Lavenza::config('bots'))) {
            Lavenza::io('NO_BOT_CONFIG_FOUND');

            return false;
        }

        // If the array of ids is empty, we assume that we must summon all of the bots found in config.
        if (empty($ids)) {
            // Fetch all bot configurations.
            $bots_to_summon = Lavenza::config('bots');
            // Unset development bot configuration
            unset($bots_to_summon['development']);
            self::instantiateBots($bots_to_summon);

            return true;
        }

        // If the array of ids isn't empty, loop in them and instantiate each bot.
        foreach ($ids as $id) {
            self::deployBot($id);
        }

        return true;
    }

    /**
     * Deploy a single bot.
     *
     * @param $id
     *
     * @return bool|null
     */
    public static function deployBot($id) : ?bool
    {
        // Check for the individual bot configuration.
        if (!isset(Lavenza::config('bots')[$id])) {
            Lavenza::io('NO_BOT_CONFIG_FOUND_FOR_SINGLE_BOT', [$id]);

            return false;
        }
        // Set bot to be summoned.
        $bots_to_summon[$id] = Lavenza::config('bots')[$id];

        self::instantiateBots($bots_to_summon);
    }

    /**
     * @param $bot_config_array
     */
    private static function instantiateBots($bot_config_array) : void
    {
        // Instantiate and authenticate all of the bots and their clients.
        foreach ($bot_config_array as $bot_id => $bot_config) {

            // Check if the bot has already been instantiated.
            if (isset(self::$bots[$bot_id])) {
                Lavenza::io('BOT_ALREADY_SUMMONED');
                continue;
            }

            self::$bots[$bot_id] = new Bot($bot_id, $bot_config);
            self::$bots[$bot_id]->summon();
        }
    }
}
