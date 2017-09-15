<?php

namespace Wiscord;

class ClientFactory
{
    private $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function create(ConfigResolver $config)
    {
        return new Client(
            $config(),
            new \Ratchet\Client\WebSocket(),
            new \Clue\React\Buzz\Browser(),
            $this->logger
        );
    }
}
