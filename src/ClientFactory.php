<?php

namespace Wiscord;

class ClientFactory
{
    public function __construct()
    {

    }

    public function create(Struct\Config $config)
    {
        return new Client(
            $config,
            new \Ratchet\Client\WebSocket(),
            new \Clue\React\Buzz\Browser(),
            new \Monolog\Logger()
        );
    }
}
