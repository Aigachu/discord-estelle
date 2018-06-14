<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Client\DiscordClient;

use Aigachu\Lavenza\Client\ClientInterface;
use CharlotteDunois\Yasmin\Client as YasminClient;
use React\EventLoop\Factory as ReactEventLoopFactory;
use React\EventLoop\LibEventLoop;
use React\EventLoop\ExtEventLoop;
use React\EventLoop\LibEvLoop;
use WebDriver\Exception;

/**
 * Class LavenzaClient
 * Lavenza's core. This class will house the core functionality of the bot.
 *
 * @package Aigachu\Lavenza
 */
abstract class DiscordClientBase extends YasminClient implements ClientInterface
{
    /**
     * @var String $token
     */
    public $token;

    /**
     * @var LibEventLoop|ExtEventLoop|LibEvLoop $loop
     */
    protected $loop;

    /**
     * @var array $listeners
     */
    protected $listeners;

    /**
     * LavenzaClient constructor.
     * @param String $token
     * @param array $options
     * @param null $loop
     */
    function __construct(String $token, array $options = array(), $loop = null)
    {
        // Initialize the React Loop.
        if (is_null($loop)) {
            $this->loop = ReactEventLoopFactory::create();
        } else {
            $this->loop = $loop;
        }

        // Set the token to the client.
        $this->token = $token;

        // Listener for Ready event.
        $this->on('ready', function () {
            echo 'Logged in as '.$this->user->tag.' created on '.$this->user->createdAt->format('d.m.Y H:i:s').PHP_EOL;
        });

        // Listener for Message event.
        $this->on('message', function ($message) {
            echo 'Received Message from '.$message->author->tag.' in '.($message->channel->type === 'text' ? 'channel #'.$message->channel->name : 'DM').' with '.$message->attachments->count().' attachment(s) and '.\count($message->embeds).' embed(s)'.PHP_EOL;
        });

        // Run CharlotteDunois's Client Constructor
        parent::__construct($options, $loop);
    }

    /**
     * Login function
     */
    public function authenticate() {
        try {
            // Runs Yasmin's default login function with the given token.
            parent::login($this->token);

            // Run React EventLoop.
            $this->loop->run();
        } catch (Exception $e) {
            throwException($e);
        }
    }
}