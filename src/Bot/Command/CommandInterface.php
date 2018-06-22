<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Command;

use Aigachu\Lavenza\Bot\Client\ClientInterface;

/**
 * Interface CommandInterface
 * @package Aigachu\Lavenza\Bot\Command
 */
interface CommandInterface
{
    /**
     * @param ClientInterface $client
     * @param $message
     * @return mixed
     */
    public static function execute($client, $message);
}