<?php
/**
 * Project Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Bot\Client\DiscordClient;

use Aigachu\Lavenza\Bot\BotInterface;
use Aigachu\Lavenza\Lavenza;
use CharlotteDunois\Yasmin\Client as YasminClient;
use CharlotteDunois\Yasmin\HTTP\DiscordAPIException;
use Aigachu\Lavenza\Bot\Command\CommandInterface;

/**
 * Class LavenzaClient
 * Lavenza's core. This class will house the core functionality of the bot.
 *
 * @package Aigachu\Lavenza
 */
class DiscordClient extends YasminClient implements DiscordClientInterface
{

    /**
     * @const string CLIENT_TYPE
     */
    public const CLIENT_TYPE = 'discord';

    /**
     * @var BotInterface $bot
     */
    protected $bot;

    /**
     * @var array $config
     */
    protected $config;

    /**
     * LavenzaClient constructor.
     *
     * @param BotInterface $bot
     * @param array        $options
     *
     * @throws \Exception
     */
    public function __construct(BotInterface $bot, array $options = [])
    {
        // Run Yasmin's Client Constructor
        parent::__construct($options, Lavenza::loop());

        // Set bot object to client.
        $this->bot = $bot;

        // Set the client's configuration taken from the Bot.
        $this->config = $this->bot->getConfig()['clients'][self::CLIENT_TYPE];

        // Set the token to the client.
        $this->token = $this->config['token'];

        // Event manager for Ready event.
        $this->on('ready', function () {
            // Run Boot tasks
            $this->runBootTasks();

            // Console log to confirm ready state.
            echo 'Logged in as '.$this->user->tag.' created on ' .$this->user->createdAt->format('d.m.Y H:i:s').PHP_EOL;

          }
        );

        // Event manager for Message event.
        $this->on('message', function ($message) {
            $this->listenForCommand($message);
          }
        );
    }

    /**
     * Listen for a command to run.
     *
     * @param $message
     */
    private function listenForCommand($message)
    {
        // Check if the beginning of the message is the command prefix or the bot's tag.
        if (strpos($message->content, $this->config['cprefix']) === 0) {
          $commands = $this->bot->getCommands();
          var_dump($commands);
          foreach ($this->bot->getCommands('universal') as $command) {
            echo $message->content;
            echo $command->key;
            if (strpos($message->content, $command->key) === 0 + \strlen($this->config['cprefix'])) {
              echo "we're in...";
              /** @var CommandInterface $command **/
              $command::execute($this, $message);
            }
          }

            foreach ($this->bot->getCommands('discord') as $command) {
              if (strpos($message->content, $command->key) === 0 + \strlen($this->config['cprefix'])) {
                echo "we're in...";
                /** @var CommandInterface $command **/
                $command::execute($this, $message);
              }
            }
        }
    }

    /**
     * Basic function to reply to a message that was heard.
     *
     * @param $message
     *
     * @return mixed|void
     */
    public function reply($message, $text)
    {
        $message->channel->send($text);
    }

    /**
     * Login function
     *
     * @TODO - Documentation
     */
    public function authenticate()
    {
        try {
            // Runs Yasmin's default login function with the given token.
            parent::login($this->token);
        } catch (DiscordAPIException $e) {
            throwException($e);
        }
    }

    /**
     * Introduction
     * This is the message that will be sent to the bot's configured "Home"
     * channel.
     */
    public function intro()
    {
        // TODO: Implement intro() method.
    }

    /**
     * Sets the activity if one is specified, if not, uses the default one set
     * for the bot if present.
     *
     * @param string $activity
     *
     * @return mixed|void
     */
    public function activity($activity = '')
    {
        if (empty($activity)) {
            $activity = $this->config['activity'];
        }

        $this->user->setActivity($activity);
    }

    /**
     * Ready function
     *
     * @TODO - Documentation
     */
    public function runBootTasks()
    {
        $this->activity();
    }
}
