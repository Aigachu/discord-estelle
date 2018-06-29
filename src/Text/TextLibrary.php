<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Text;

use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class TextConstants
 * @package Aigachu\Lavenza\Text
 */
abstract class TextLibrary
{
    // Declare class as Singleton.
    use SingletonTrait;

    // === Bot Bunker Error Texts ===
    const NO_BOT_CONFIG_FOUND                       = "There doesn't seem to be any configuration for bots. Please create a configuration file and try again.";
    const NO_BOT_CONFIG_FOUND_FOR_SINGLE_BOT        = "Configuration not found for the requested summoning of the \"@1\" bot. Please verify or create a configuration file.";
    const NO_BOT_CONFIG_FOUND_FOR_REQUESTED_BOTS    = "There doesn't seem to be any configuration for the requested bots. Please create a configuration file and try again.";
    const BOT_ALREADY_SUMMONED                      = "The @1 bot has already been summoned. Skipping summoning process...";

    // === Module Loading Error Texts ===
    const NO_MODULE_FOUND_FOR_BOT                   = "The \"@1\" module could not be loaded for the \"@2\" bot. Please check configurations.";
    const FAILED_MODULE_LOAD                        = "The \"@1\" module could not be loaded. This module was not found.";
}