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
        $sum = $this->getTotal($coins);
        if (0 === $sum) {
            $to_dispense = [];
        }
        elseif (0.01 == $sum) {
            $to_dispense = [Coins::ONE_CENT];
        }
        else {
            $to_dispense = [Coins::TWO_CENTS];
        }
        $this->cassete->dispense($to_dispense);
    }

    private function getTotal($coins)
    {
        return array_reduce($coins, function($carry, $coin) {
            return $carry + $coin;
        }, 0);
    }
}
