<?php

namespace spec\Katas\ChangeMachine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Katas\ChangeMachine\Coins;

class ChangeMachineSpec extends ObjectBehavior
{
    function let($cassete)
    {
        $cassete->beADoubleOf('Katas\ChangeMachine\Cassete');
        $this->beConstructedWith($cassete);
    }

    function it_gives_no_coins_if_no_coins_were_inserted($cassete)
    {
        $this->change([]);

        $cassete->dispense([])->shouldHaveBeenCalled();
    }

    function it_gives_the_same_coin_if_the_smallest_coin_was_inserted($cassete)
    {
        $this->change([Coins::ONE_CENT]);

        $cassete->dispense([Coins::ONE_CENT])->shouldHaveBeenCalled();
    }
}
