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
        $to_dispense = [
            '0'    => [],
            Coins::ONE_CENT => [Coins::ONE_CENT],
            Coins::TWO_CENTS => [Coins::TWO_CENTS],
            ];
        $this->cassete->dispense($to_dispense[(string)$total]);
    }

    private function getTotal($coins)
    {
        return array_reduce($coins, function($carry, $coin) {
            return $carry + $coin;
        }, 0);
    }
}
