<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

use Symfony\Component\Yaml\Yaml;

/**
 * Trait BotConfigurable
 * @package Aigachu\Lavenza\Bot
 */
trait BotConfigurable
{
    /**
     * @return mixed
     * @TODO - Proper error handling.
     */
    private function getConfig() {
        try {
            $bot_id = self::ID;
            $yaml = Yaml::parse(file_get_contents(ROOT . "$bot_id/config.yml"));

            if (!isset($yaml[$bot_id])) {
                echo "Configuration seems to be missing for $bot_id. Please add proper configuration for $bot_id in the 'config.yml' file found at the root of the application.";
            }
            return $yaml[$bot_id];
        } catch (\Exception $e) {
            echo 'WHAT THE FSAFTUV?'; // LMAO.
            exit(0);
        }
    }
}