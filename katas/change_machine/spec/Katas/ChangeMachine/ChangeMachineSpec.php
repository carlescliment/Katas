<?php

namespace spec\Katas\ChangeMachine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Katas\ChangeMachine\Coins;
use Katas\ChangeMachine\Changer;
use Katas\ChangeMachine\Stock;

class ChangeMachineSpec extends ObjectBehavior
{
    function let($cassete)
    {
        $cassete->beADoubleOf('Katas\ChangeMachine\Cassete');
        $this->beConstructedWith($cassete, new Changer(new Stock()));
    }

    function it_gives_no_coins_if_no_coins_were_inserted($cassete)
    {
        $this->change([]);

        $cassete->dispense([])->shouldHaveBeenCalled();
    }

    function it_gives_1x1c_for_1x1c($cassete)
    {
        $this->change([Coins::ONE_CENT]);

        $cassete->dispense([Coins::ONE_CENT])->shouldHaveBeenCalled();
    }

    function it_gives_1x2c_for_2x1c($cassete)
    {
        $this->change([Coins::ONE_CENT, Coins::ONE_CENT]);

        $cassete->dispense([Coins::TWO_CENTS])->shouldHaveBeenCalled();
    }

    function it_gives_1x5c_for_2x2c_plus_1x1c($cassete)
    {
        $this->change([Coins::TWO_CENTS, Coins::TWO_CENTS, Coins::ONE_CENT]);

        $cassete->dispense([Coins::FIVE_CENTS]);
    }

    function it_gives_1x5c_plus_1x1c_for_3x2c($cassete)
    {
        $this->change([Coins::TWO_CENTS, Coins::TWO_CENTS, Coins::TWO_CENTS]);

        $cassete->dispense([Coins::FIVE_CENTS, Coins::ONE_CENT]);
    }
}
