<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

// Require composer autoloader.
require __DIR__.'/vendor/autoload.php';

// Set a constant for the ROOT of the project codebase.
const ROOT_PATH = __DIR__.'/';

// Set a constant for the root of the configuration path.
const CONFIG_PATH = ROOT_PATH.'config/';

/**
 * Include all files in the ./includes folder.
 * This allows for better organization of files that should automatically be
 * included in the project.
 */
foreach (glob(__DIR__.'/includes/*.php') as $filename) {
    $filename = str_replace(__DIR__.'/', '', $filename);
    include_once $filename;
}

// Import Lavenza Core.
use Aigachu\Lavenza\Lavenza;

/**
 * Script Options
 *
 * @option NoValue --debug - Summon Mikuchu, the development bot.
 */
$options = getopt(
    'd', [
        'debug',
    ]
);

// If the debug option is set, we only want to run the development bot.
// Otherwise, run the specified bots below. If no bots are specified, run them all.
if (isset($options['debug'])) {
    // Jack in! Lavenza, Execute!!!
    Lavenza::summon(['development'])->run();
} else {
    // Jack in! Lavenza, Execute!!!
    Lavenza::summon([])->run();
}