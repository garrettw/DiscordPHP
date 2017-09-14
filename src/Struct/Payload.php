<?php

namespace Wiscord\Struct;

class Payload
{
    private $opcode;

    private $data;

    private $sequence = null;

    private $type = null;

    public function __construct(array $data)
    {
        $this->opcode = $data['op'];
        $this->data = $data['d'];

        if ($data['op'] === 0) {
            $this->sequence = $data['s'];
            $this->type = $data['t'];
        }
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
}
