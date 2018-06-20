<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Client\DiscordClient;

use Aigachu\Lavenza\Bot\BotInterface;
use Aigachu\Lavenza\Lavenza;
use CharlotteDunois\Yasmin\Client as YasminClient;
use CharlotteDunois\Yasmin\HTTP\DiscordAPIException;

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
    const CLIENT_TYPE = 'discord';

    /**
     * @var BotInterface $bot
     */
    protected $bot;

    /**
     * @var String $token
     */
    public $token;

    /**
     * @var array $listeners
     */
    protected $listeners;

    /**
     * LavenzaClient constructor.
     * @param BotInterface $bot
     * @param array $options
     */
    function __construct(BotInterface $bot, array $options = array())
    {
        // Set the token to the client.
        $this->token = $bot->getConfig()['clients'][self::CLIENT_TYPE]['token'];

        // Listener for Ready event.
        $this->on('ready', function () {
            echo 'Logged in as '.$this->user->tag.' created on '.$this->user->createdAt->format('d.m.Y H:i:s').PHP_EOL;
        });

        // Listener for Message event.
        $this->on('message', function ($message) {
            echo 'Received Message from '.$message->author->tag.' in '.($message->channel->type === 'text' ? 'channel #'.$message->channel->name : 'DM').' with '.$message->attachments->count().' attachment(s) and '.\count($message->embeds).' embed(s)'.PHP_EOL;
        });

        // Run Yasmin's Client Constructor
        parent::__construct($options, Lavenza::loop());
    }

    /**
     * Login function
     */
    public function authenticate() {
        try {
            // Runs Yasmin's default login function with the given token.
            parent::login($this->token);
        } catch (DiscordAPIException $e) {
            throwException($e);
        }
    }

    /**
     * Introduction
     * This is the message that will be sent to the bot's configured "Home" channel.
     */
    public function intro()
    {
        // TODO: Implement intro() method.
    }

    /**
     * Sets the activity if one is specified, if not, uses the default one set for the bot if present.
     * @param string $activity
     * @return mixed|void
     */
    public function activity($activity = '')
    {
        // TODO: Implement activity() method.
    }
}