<?php

// Require Composer Autoloader
require __DIR__ . '/vendor/autoload.php';

// Set a constant for the ROOT of the project codebase.
const ROOT_PATH = __DIR__ . "/";

// Set a constant for the root of the configuration path.
const CONFIG_PATH = ROOT_PATH . "config/";

// Import Lavenza.
use Aigachu\Lavenza\Lavenza;

// Script Options
//$longopts  = array(
//    "required:",     // Required value
//    "optional::",    // Optional value
//    "option",        // No value
//    "opt",           // No value
//);

$options = getopt('d', [
  'debug'
]);

// If the debug option is set, we only want to run the development bot.
// Otherwise, run the specified bots below.
if (isset($options['debug'])) {
    // Jack in! Lavenza, Execute!!!
    Lavenza::summon(['development'])->run();
} else {
    // Jack in! Lavenza, Execute!!!
    Lavenza::summon([])->run();
}