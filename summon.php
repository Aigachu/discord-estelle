<?php

// Require Vendor Composer Autoloader
require __DIR__ . '/vendor/autoload.php';

// Require Project Autoloader
require __DIR__ . '/autoload.php';

// Require Configurations
if (file_exists(__DIR__ . '/config.php')) {
    $config = [];
    require __DIR__ . '/config.php';
} else {
    echo "\nPlease verify that a configuration file is present in the directory.\n";
    echo "If needed, create one basing yourself on the example.config.php file found in this directory.\n";
    exit();
}

// Use Main Lavenza class as core.
use Aigachu\Lavenza\Lavenza as Core;

// Instantiate Lavenza.
$lavenza = new Core($config);

// Jack in! Lavenza, Execute!!!
$lavenza->jackIn();
