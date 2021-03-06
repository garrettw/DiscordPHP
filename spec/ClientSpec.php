<?php

namespace spec\Wiscord;

use Wiscord\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function let()
    {
        $this->beInitializedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_launches()
    {
        $this->launch()->shouldReturn(true);
    }
}
