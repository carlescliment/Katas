<?php

namespace Katas\ChangeMachine;

class ChangeMachine
{
    private $cassete;
    private $stock;

    public function __construct(Cassete $cassete)
    {
        $this->cassete = $cassete;
        $this->stock = new Stock();
    }

    public function change(array $coins)
    {
        $this->dispenseFor($this->getTotal($coins));
    }

    private function dispenseFor($total)
    {
        $changer = new Changer();
        $coins = $changer->change($total, $this->stock);
        $this->cassete->dispense($coins);
    }

    private function getTotal($coins)
    {
        return array_reduce($coins, function($carry, $coin) {
            return $carry + $coin;
        }, 0);
    }
}
