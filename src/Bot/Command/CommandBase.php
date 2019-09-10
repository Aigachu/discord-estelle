<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Command;

use Aigachu\Lavenza\Bot\Listener\CommandListener\CommandListenerInterface;
use Aigachu\Lavenza\Model\Singleton\SingletonTrait;

/**
 * Class CommandBase
 *
 * @package Aigachu\Lavenza\Bot\Command
 */
abstract class CommandBase implements CommandInterface
{

    /**
     * @var String $key
     */
    protected $key;

    /**
     * @var array $aliases
     */
    protected $aliases = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var String $allowedApps
     */
    protected $env = 'universal';

    // Declare commands as singletons.
    use SingletonTrait;

    /**
     * CommandBase constructor.
     */
    protected function __construct()
    {
        // Set default key value.
        if ($this->key === null) {
            $this->key = str_replace('Command', '', __CLASS__);
        }
    }

    /**
     * Abstract function. Each command will have an 'execute' function.
     *
     * @inheritdoc
     */
    abstract public static function execute($client, $message);

    /**
     * @return String
     */
    public function getKey() : String
    {
        return $this->key;
    }

    /**
     * @return array
     */
    public function getAliases() : array
    {
        return $this->aliases;
    }

    /**
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * @return String
     */
    public function getEnv() : String
    {
        return $this->env;
    }
}
