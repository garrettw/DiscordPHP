<?php

namespace Wiscord\Struct;

class Config
{
    private $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function __get($prop)
    {
        return $this->options[$prop];
    }
}
