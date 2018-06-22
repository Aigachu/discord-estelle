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
use Aigachu\Lavenza\Text\TextManager;
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
     * Deploy & Run all clients.
     */
    public static function run() {
        self::loop()->run();
    }

    /**
     * Get text from TextLibrary.
     * @param $constant
     * @param array $placeholder_values
     * @return mixed
     */
    public static function getText($constant, $placeholder_values = []) {
        return TextManager::get($constant, $placeholder_values);
    }

    /**
     * Send an echo out to the console.
     * @param $text
     * @param array $placeholder_values
     * @return mixed
     */
    public static function io($text, $placeholder_values = []) {

        // Attempt to find text in the TextLibrary.
        if (TextManager::get($text, $placeholder_values))
            $text = TextManager::get($text, $placeholder_values);

        echo $text;
        echo "\n";
    }

    /**
     * Get all of the bots currently active.
     */
    public static function bots() {
        return BotBunker::getBots();
    }

    /**
     * Wrapper for the BotBunker's deploy function.
     * @param array $ids Bot IDs that should be deployed. If empty, all bots are deployed.
     * @return Lavenza
     */
    public static function summon($ids = []) {
        BotBunker::deployBots($ids);
        return new self();
    }

    /**
     * Wrapper for Configuration Repository's config function. Houses all of the configuration for
     * @param string $scope
     * @return array
     */
    public static function config($scope = 'full'): array {
        return ConfigRepository::config($scope);
    }
}