<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Client;

use Aigachu\Lavenza\Bot\Client\DiscordClient\DiscordClient;
use Aigachu\Lavenza\Bot\Client\TwitchClient\TwitchClient;

/**
 * Class ClientFactory
 * @package Aigachu\Lavenza\Bot\Client
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

//            case 'youtube':
//                return new YoutubeClient($bot);
//                break;

            // It's just a joke really. I'm going to keep making it across the code. Because who in the F!$@? would want to make a Skype bot?
            // Gross.
//             case 'skype':
//                 return new SkypeClient($bot);
//                 break;

            default:
                return null;
                break;
        }
    }
}