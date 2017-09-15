<?php

namespace Wiscord;

class Client
{
    const HTTP_API_VERSION = 6;

    const GATEWAY_VERSION = 6;

    const HTTP_API_ENDPOINT = 'https://discordapp.com/api/v';

    private $config;

    private $wsclient;

    private $httpclient;

    private $logger;

    public function __construct(
        Struct\Config $config,
        \Ratchet\Client\WebSocket $wsclient,
        \React\HttpClient\Client $httpclient,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->config = $config;
        $this->wsclient = $wsclient;
        $this->httpclient = $httpclient;
        $this->logger = $logger;
    }

    public function launch()
    {
        return true;
    }
}
