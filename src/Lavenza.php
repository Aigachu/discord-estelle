<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza;

use Aigachu\Lavenza\Bot\BotBunker;
use Aigachu\Lavenza\Configuration\ConfigRepository;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;
use Aigachu\Lavenza\Text\TextManager;
use React\EventLoop\ExtEventLoop;
use React\EventLoop\LibEventLoop;
use React\EventLoop\LibEvLoop;
use React\EventLoop\Factory as ReactEventLoopFactory;

/**
 * Provides a Core class for Lavenza.
 *
 * This class will be the entry point for many of the other components
 * in the application.
 */
class Lavenza {

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
   * Returns the application wide React EventLoop.
   * We only want one loop to run for all clients.
   *
   * @return mixed
   *   Return the React Event Loop linked to this application.
   */
  public static function loop() {

    // Check if the loop is already set. If not, create it.
    if (self::$loop === NULL) {
      self::$loop = ReactEventLoopFactory::create();
    }

    return self::$loop;
  }

  /**
   * Run the React EventLoop.
   *
   * This function should only run once, at the end of everything else.
   */
  public static function run() : void {
    self::loop()->run();
  }

  /**
   * Get text from TextLibrary.
   *
   * @param string $constant
   *   The ID of the piece of text we're requesting.
   * @param array $placeholder_values
   *   Any placeholder values that are dynamic.
   *
   * @return string
   *   The formatted text.
   */
  public static function getText($constant, array $placeholder_values = []) : string {
    return TextManager::get($constant, $placeholder_values);
  }

  /**
   * Send an echo out to the console.
   *
   * @param       $text
   * @param array $placeholder_values
   *
   */
  public static function io($text, array $placeholder_values = []) : void {

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
  public static function textManager() : TextManager {
    return TextManager::Instance();
  }

  /**
   * Return the single instance of the Bot Bunker.
   * The BotBunker is a...Bunker...For the bots.
   *
   * @return BotBunker
   */
  public static function botBunker() : BotBunker {
    return BotBunker::Instance();
  }

  /**
   * Return the single instance of the Configuration Repository
   *
   * @return ConfigRepository
   */
  public static function configRepository() : ConfigRepository {
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
  public static function summon(array $ids = []) : Lavenza {
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
  public static function config($scope = 'full') : array {
    return ConfigRepository::config($scope);
  }

}
