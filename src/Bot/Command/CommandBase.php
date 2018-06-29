<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Command;

use Aigachu\Lavenza\Bot\Listener\CommandListener\CommandListenerInterface;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class CommandBase
 * @package Aigachu\Lavenza\Bot\Command
 */
abstract class CommandBase implements CommandInterface
{
    /**
     * @var String $key
     */
    public $key;

    /**
     * @var array $aliases
     */
    public $aliases = [];

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var String $allowedApps
     */
    public $env = 'all';

    /**
     * @var CommandListenerInterface $listener
     */
    protected static $listener;

    use SingletonTrait;

    /**
     * CommandBase constructor.
     */
    protected function __construct()
    {
        // Set default key value.
        if (is_null($this->key))
            $this->key = str_replace('Command', '', __CLASS__);
    }

    /**
     * Abstract function. Each command will have an 'execute' function.
     * @inheritdoc
     */
    abstract static function execute($client, $message);
}