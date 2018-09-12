<?php
/**
 * Lavenza
 * Copyright 2017-2018 Aigachu, All Rights Reserved
 *
 * License: https://github.com/Aigachu/Lavenza/blob/master/LICENSE
 */

namespace Aigachu\Lavenza\Feature\Core\Command;

use Aigachu\Lavenza\Bot\Command\CommandBase;

/**
 * Class PingPong
 *
 * @property string $key
 * @package Aigachu\Lavenza\Module\PingModule\Command
 */
final class PingPongCommand extends CommandBase
{

    /**
     * @var string $key
     */
    public $key = 'ping';

    /**
     * @var string $key
     */
    public $env = 'discord';

    /**
     * @param \Aigachu\Lavenza\Bot\Client\ClientInterface $client
     * @param                                             $message
     *
     * @return mixed|void
     */
    public static function execute($client, $message)
    {
        $client->reply($message, 'Pong!');
    }
}