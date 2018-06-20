<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Client;
use Aigachu\Lavenza\Client\DiscordClient\DiscordClient;
use Aigachu\Lavenza\Client\TwitchClient\TwitchClient;

/**
 * Class ClientFactory
 * @package Aigachu\Lavenza\Client
 */
abstract class ClientFactory
{
    public static function instantiate($type, $bot) {
        switch($type) {

            case 'discord':
                return new DiscordClient($bot);
                break;

            case 'twitch':
                return new TwitchClient($bot);
                break;

            default:
                return null;
                break;
        }
    }
}