<?php

namespace spec\Katas\ChangeMachine;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Katas\ChangeMachine\Coin;
use Katas\ChangeMachine\Changer;
use Katas\ChangeMachine\Stock;

class ChangeMachineSpec extends ObjectBehavior
{
    function let($cassete)
    {
        $cassete->beADoubleOf('Katas\ChangeMachine\Cassete');
        $coins = [new Coin('0.05'), new Coin('0.02'), new Coin('0.01')];
        $this->beConstructedWith($cassete, new Changer(new Stock($coins)));
    }

    function it_gives_no_coins_if_no_coins_were_inserted($cassete)
    {
        $this->change([]);

        $cassete->dispense([])->shouldHaveBeenCalled();
    }

    function it_gives_1x1c_for_1x1c($cassete)
    {
        $this->change(['0.01']);

        $cassete->dispense(['0.01'])->shouldHaveBeenCalled();
    }

    function it_gives_1x2c_for_2x1c($cassete)
    {
        $this->change(['0.01', '0.01']);

        $cassete->dispense(['0.02'])->shouldHaveBeenCalled();
    }

    function it_gives_1x5c_for_2x2c_plus_1x1c($cassete)
    {
        $this->change(['0.02', '0.02', '0.01']);

        $cassete->dispense(['0.05']);
    }

    function it_gives_1x5c_plus_1x1c_for_3x2c($cassete)
    {
        $this->change(['0.02', '0.02', '0.02']);

        $cassete->dispense(['0.05', '0.01']);
    }
}
