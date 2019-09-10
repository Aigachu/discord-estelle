<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Client;

/**
 * Interface ClientInterface
 *
 * @package Aigachu\Lavenza\Bot\Client
 */
interface ClientInterface
{

    /**
     * Login to the service this Client is linked to.
     *
     * @return mixed
     */
    public function authenticate();

    /**
     * @param mixed  $message
     * @param String $text
     *
     * @return mixed
     */
    public function reply($message, $text);
}
