<?php

// Require Vendor Composer Autoloader
require __DIR__ . '/vendor/autoload.php';

// Set a constant for the ROOT of the project codebase.
const ROOT_PATH = __DIR__ . "/";

// Set a constant for the root of the configuration path.
const CONFIG_PATH = ROOT_PATH . "config/";

// Import Lavenza.
use Aigachu\Lavenza\Lavenza;

// Jack in! Lavenza, Execute!!!
Lavenza::run();