<?php

namespace Katas\ChangeMachine;

class ChangeMachine
{
    private $cassete;
    private $changer;

    public function __construct(Cassete $cassete)
    {
        $this->cassete = $cassete;
        $this->changer = new Changer(new Stock());
    }

    public function change(array $coins)
    {
        $this->dispense($this->coinsFor($this->totalize($coins)));

        return $this;
    }

    private function dispense(array $coins)
    {
        return $this->cassete->dispense($coins);
    }

    private function coinsFor($amount)
    {
        return $this->changer->change($amount);
    }

    private function totalize(array $coins)
    {
        return array_reduce($coins, function($carry, $coin) {
            return $carry + $coin;
        }, 0);
    }
}
