<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

/**
 * Interface BotInterface
 *
 * @package Aigachu\Lavenza\Bot
 */
interface BotInterface
{

    /**
     * @return mixed
     */
    public function getConfig();

    /**
     * @return mixed
     */
    public function getFeatures();

    /**
     * @param null $environment
     *
     * @return mixed
     */
    public function getCommands($environment = null);
}