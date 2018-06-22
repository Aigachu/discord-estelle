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
use Aigachu\Lavenza\Module\ModuleManager;
use Aigachu\Lavenza\Singleton\SingletonTrait;
use Aigachu\Lavenza\Text\TextManager;
use React\EventLoop\ExtEventLoop;
use React\EventLoop\LibEventLoop;
use React\EventLoop\LibEvLoop;
use React\EventLoop\Factory as ReactEventLoopFactory;

/**
 * Class Lavenza
 * Core class that will house utility functions and wrappers for many of the other components in the application.
 */
class Lavenza
{
    // Define this class as a Singleton.
    use SingletonTrait;

    // Lavenza's version. Try to remember to increment this. ;D
    const VERSION = '0.0.1';

    /**
     * React EventLoop.
     * @var ExtEventLoop|LibEventLoop|LibEvLoop $loop
     */
    protected static $loop = null;

    /**
     * Lavenza constructor.
     * @param null $loop
     */
    protected function __construct($loop = null)
    {
    }

    /**
     * Returns the application wide React EventLoop.
     * We only want one loop to run for all clients.
     */
    public static function loop() {
        if (is_null(self::$loop)) {
            self::$loop = ReactEventLoopFactory::create();
        }
        return self::$loop;
    }

    /**
     * Run the React EventLoop.
     * @Note This function should only run once, at the end of everything else.
     */
    public static function run() {
        self::loop()->run();
    }

    /**
     * Get text from TextLibrary.
     * @param $constant
     * @param array $placeholder_values
     * @return string
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
     * Return the single instance of the Module Manager.
     */
    public static function textManager() {
        return TextManager::Instance();
    }

    /**
     * Return the single instance of the Module Manager.
     */
    public static function moduleManager() {
        return ModuleManager::Instance();
    }

    /**
     * Return the single instance of the Bot Bunker.
     * @return BotBunker
     */
    public static function botBunker() {
        return BotBunker::Instance();
    }

    /**
     * Return the single instance of the Configuration Repository
     * @return ConfigRepository
     */
    public static function configRepository() {
        return ConfigRepository::Instance();
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