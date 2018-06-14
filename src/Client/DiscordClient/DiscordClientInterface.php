<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Client\DiscordClient;

/**
 * Interface DiscordClientInterface
 * @package Aigachu\Lavenza\Client\DiscordClient
 */
interface DiscordClientInterface
{
    /**
     * @return mixed
     */
    public function introduction();

    /**
     * @return mixed
     */
    public function playing();
}