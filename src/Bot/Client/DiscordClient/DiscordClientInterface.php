<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Client\DiscordClient;

use Aigachu\Lavenza\Bot\Client\ClientInterface;

/**
 * Interface DiscordClientInterface
 * @package Aigachu\Lavenza\Bot\Client\DiscordClient
 */
interface DiscordClientInterface extends ClientInterface
{
    /**
     * @return mixed
     */
    public function intro();

    /**
     * @return mixed
     */
    public function activity();
}