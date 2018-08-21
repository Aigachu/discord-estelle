<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot;

use Aigachu\Lavenza\Lavenza;
use Aigachu\Lavenza\Bot\Client\ClientInterface;
use Aigachu\Lavenza\Bot\Client\ClientFactory;
use WebDriver\Exception;

/**
 * Class Bot
 * @package Aigachu\Lavenza\Bot
 */
class Bot implements BotInterface
{
    /**
     * Identification of the bot obtained from configurations.
     * This ID will be used for personifications down the line.
     * @var string $id
     */
    public $id;

    /**
     * Clients that Lavenza will use.
     * i.e. Discord, Twitch, Youtube, Skype (LMAO JK!!! GROSS), etc!
     * @var array $clients
     */
    protected $clients;

    /**
     * Features that the bot will utilize.
     * @var array $modules
     */
    protected $features;

    /**
     *
     */
    protected $commands = [];

    /**
     * Configuration array claimed from the config.yml file at the root of the project.
     * Follow the instructions in that file to get Lavenza to run properly.
     * A token must be configured for each client that is supposed to run.
     * @var array $config
     */
    protected $config;

    /**
     * Bot constructor.
     * @param $id
     * @param $config
     */
    public function __construct($id, $config)
    {
        $this->id = $id;
        $this->config = $config;

        // Initialize features
        if (isset($this->config['features']))
            $this->buildFeatures($this->config['features']);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @return array
     */
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @param $environment
     * @return mixed
     */
    public function getCommands($environment = null)
    {
        if (is_null($environment))
            return $this->commands;

        if (!isset($this->commands[$environment]))
            return [];

        return $this->commands[$environment];
    }

    /**
     * Lavenza Jack In function.
     * Login to the Discord server with all of Lavenza's bot clients.
     */
    public function summon(): bool {

        // Initialize Clients
        if (isset($this->config['clients']))
            $this->initializeClients($this->config['clients']);

        // Authenticate Clients
        foreach ($this->clients as $client) {
            /**
             * @var ClientInterface $client
             */
            $client->authenticate();
        }

        return true;
    }

    /**
     * @param $clients_config
     */
    private function initializeClients($clients_config) {
        try {
            // Instantiate Clients with the given configurations.
            foreach ($clients_config as $client_type => $client_config) {
                $this->clients[$client_type] = ClientFactory::instantiate($client_type, $this);
            }
        } catch(Exception $e) {
            Lavenza::io("Hello?");
        }
    }

    /**
     * @param $modules_config
     */
    private function buildFeatures($modules_config) {
        try {
            // Initialize Modules with the given configurations.
            foreach ($modules_config as $feature_name) {

                // Load the module with the module manager.
                $feature = Lavenza::featureManager()->load($feature_name);

                // If the module could not be loaded, we'll skip this module and throw an error.
                if (is_null($feature)) {
                    Lavenza::io('NO_MODULE_FOUND_FOR_BOT', [$feature_name, $this->id]);
                    continue;
                }

                // Set the module and the commands.
                $this->features[$feature_name] = $feature;
                $this->commands = array_merge_recursive($this->commands, $this->features[$feature_name]->getCommands());
            }
        } catch(Exception $e) {
            Lavenza::io("Hello?");
        }
    }
}