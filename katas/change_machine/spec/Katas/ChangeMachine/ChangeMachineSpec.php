<?php

namespace spec\Katas\ChangeMachine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChangeMachineSpec extends ObjectBehavior
{
    function it_gives_no_coins_if_no_coins_were_inserted($cassete)
    {
        $cassete->beADoubleOf('Katas\ChangeMachine\Cassete');
        $this->beConstructedWith($cassete);

        $this->change([]);

        $cassete->dispense([])->shouldBeCalled();
    }

}
