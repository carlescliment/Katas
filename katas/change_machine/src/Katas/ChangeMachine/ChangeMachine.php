<?php

namespace Katas\ChangeMachine;

class ChangeMachine
{
    private $cassete;

    public function __construct(Cassete $cassete)
    {
        $this->cassete = $cassete;
    }

    public function change(array $coins)
    {
        $this->dispenseFor($this->getTotal($coins));
    }

    private function dispenseFor($total)
    {
        $rest = $total;
        $coins = [];
        while ($rest > 0) {
            $biggest = Coins::biggestFor($rest);
            $coins[] = $biggest;
            $rest -= $biggest;
        }
        $this->cassete->dispense($coins);
    }

    private function getTotal($coins)
    {
        return array_reduce($coins, function($carry, $coin) {
            return $carry + $coin;
        }, 0);
    }
}
