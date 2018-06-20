<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza;

use Aigachu\Lavenza\Bot\BotBunker;
use Aigachu\Lavenza\Configuration\ConfigRepository;
use React\EventLoop\ExtEventLoop;
use React\EventLoop\LibEventLoop;
use React\EventLoop\LibEvLoop;
use React\EventLoop\Factory as ReactEventLoopFactory;

/**
 * Class Lavenza
 */
class Lavenza
{

    /**
     * @var array $bots
     */
    public static $bots;

    /**
     * @var ExtEventLoop|LibEventLoop|LibEvLoop $loop
     */
    protected static $loop = null;

    /**
     * Returns the application wide React Event Loop.
     */
    public static function loop() {
        if (is_null(self::$loop)) {
            self::$loop = ReactEventLoopFactory::create();
        }

        return self::$loop;
    }

    /**
     * Run all clients.
     */
    public static function run() {
        self::deploy();
        self::loop()->run();
    }

    /**
     * Wrapper for the BotBunker.
     */
    public static function deploy() {
        BotBunker::deploy();
    }

    /**
     * Wrapper for Configuration Repository.
     * @return array
     */
    public static function config() {
        return ConfigRepository::config();
    }
}