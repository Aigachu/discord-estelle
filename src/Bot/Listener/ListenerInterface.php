<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Listener;

/**
 * Interface ListenerInterface
 *
 * @package Aigachu\Lavenza\Bot\Listener
 */
interface ListenerInterface
{

    // Function that sets up what the listener listens for.
    public function listen($content);

    // Function that sets up what the listener does if it hears what it wants to hear.
    public function execute();
}