<?php

namespace Wiscord\Struct;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Monolog\Logger as Monolog;

class ConfigFactory
{
    private $resolver;

    private $logger;

    public function __construct(OptionsResolver $resolver, Monolog $logger)
    {
        $this->resolver = $resolver;
        $this->logger = $logger;
    }

    public function resolve(array $options)
    {
        $this->resolver
            ->setRequired('token')
            ->setAllowedTypes('token', 'string')
            ->setDefined([
                'token',
                'bot',
                'shardId',
                'shardCount',
                'loop',
                'logger',
                'loggerLevel',
                'logging',
                'cachePool',
                'loadAllMembers',
                'disabledEvents',
                'pmChannels',
                'storeMessages',
                'retrieveBans',
            ])
            ->setDefaults([
                'loop'           => LoopFactory::create(),
                'bot'            => true,
                'logger'         => null,
                'loggerLevel'    => Monolog::INFO,
                'logging'        => true,
                'cachePool'      => new ArrayCachePool(),
                'loadAllMembers' => false,
                'disabledEvents' => [],
                'pmChannels'     => false,
                'storeMessages'  => false,
                'retrieveBans'   => true,
            ])
            ->setAllowedTypes('bot', 'bool')
            ->setAllowedTypes('loop', LoopInterface::class)
            ->setAllowedTypes('logging', 'bool')
            ->setAllowedTypes('cachePool', CacheItemPoolInterface::class)
            ->setAllowedTypes('loadAllMembers', 'bool')
            ->setAllowedTypes('disabledEvents', 'array')
            ->setAllowedTypes('pmChannels', 'bool')
            ->setAllowedTypes('storeMessages', 'bool')
            ->setAllowedTypes('retrieveBans', 'bool');

        $options = $this->resolver->resolve($options);

        if (is_null($options['logger'])) {
            $this->logger->pushHandler(new StreamHandler('php://stdout', $options['loggerLevel']));
            $options['logger'] = $logger;
        }

        return $options;
    }
}