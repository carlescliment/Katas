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

    function it_gives_one_cent_if_one_cent_was_inserted($cassete)
    {
        $this->change([Coins::ONE_CENT]);

        $cassete->dispense([Coins::ONE_CENT])->shouldHaveBeenCalled();
    }

    function it_gives_a_coin_of_two_cents_for_two_coins_of_one_cent($cassete)
    {
        $this->change([Coins::ONE_CENT, Coins::ONE_CENT]);

        $cassete->dispense([Coins::TWO_CENTS])->shouldHaveBeenCalled();
    }
}
