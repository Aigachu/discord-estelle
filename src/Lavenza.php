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
use Aigachu\Lavenza\Feature\FeatureManager;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;
use Aigachu\Lavenza\Text\TextManager;
use React\EventLoop\ExtEventLoop;
use React\EventLoop\LibEventLoop;
use React\EventLoop\LibEvLoop;
use React\EventLoop\Factory as ReactEventLoopFactory;

/**
 * Class Lavenza
 * Core class that will house utility functions and wrappers for many of the
 * other components in the application.
 */
class Lavenza
{

    // Define this class as a Singleton.
    use SingletonTrait;

    // Lavenza's version. Try to remember to increment this. ;D
    public const VERSION = '0.0.1';

    /**
     * React EventLoop.
     *
     * @var ExtEventLoop|LibEventLoop|LibEvLoop $loop
     */
    protected static $loop;

    /**
     * Lavenza constructor.
     *
     * @param null $loop
     */
    protected function __construct($loop = null)
    {
    }

    /**
     * Returns the application wide React EventLoop.
     * We only want one loop to run for all clients.
     */
    public static function loop()
    {
        if (self::$loop === null) {
            self::$loop = ReactEventLoopFactory::create();
        }

        return self::$loop;
    }

    /**
     * Run the React EventLoop.
     *
     * @Note This function should only run once, at the end of everything else.
     */
    public static function run() : void
    {
        self::loop()->run();
    }

    /**
     * Get text from TextLibrary.
     *
     * @param       $constant
     * @param array $placeholder_values
     *
     * @return string
     */
    public static function getText($constant, array $placeholder_values = []
    ) : string {
        return TextManager::get($constant, $placeholder_values);
    }

    /**
     * Send an echo out to the console.
     *
     * @param       $text
     * @param array $placeholder_values
     *
     */
    public static function io($text, array $placeholder_values = []) : void
    {

        // Attempt to find text in the TextLibrary.
        if (TextManager::get($text, $placeholder_values)) {
            $text = TextManager::get($text, $placeholder_values);
        }

        // Output the text to the console.
        echo $text;
        echo "\n";
    }

    /**
     * Return the single instance of the Text Manager.
     * This is the TextManager. It'll manager fetching texts out of the Text
     * Library.
     */
    public static function textManager() : TextManager
    {
        return TextManager::Instance();
    }

    /**
     * Return the single instance of the Module Manager.
     * The Module Manager manages bot modules. Each module is a collection of
     * commands and features.
     */
    public static function featureManager() : FeatureManager
    {
        return FeatureManager::Instance();
    }

    /**
     * Return the single instance of the Bot Bunker.
     * The BotBunker is a...Bunker...For the bots.
     *
     * @return BotBunker
     */
    public static function botBunker() : BotBunker
    {
        return BotBunker::Instance();
    }

    /**
     * Return the single instance of the Configuration Repository
     *
     * @return ConfigRepository
     */
    public static function configRepository() : ConfigRepository
    {
        return ConfigRepository::Instance();
    }

    /**
     * Wrapper for the BotBunker's deploy function.
     *
     * @param array $ids Bot IDs that should be deployed. If empty, all bots
     *                   are deployed.
     *
     * @return Lavenza
     */
    public static function summon(array $ids = []) : Lavenza
    {
        BotBunker::deployBots($ids);

        return new self();
    }

    /**
     * Wrapper for Configuration Repository's config function. Houses all of
     * the configuration for
     *
     * @param string $scope
     *
     * @return array
     */
    public static function config($scope = 'full') : array
    {
        return ConfigRepository::config($scope);
    }
}