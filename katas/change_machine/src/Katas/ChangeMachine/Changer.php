<?php

namespace Katas\ChangeMachine;

class Changer
{
    private $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function change($total)
    {
        $rest = $total;
        $coins = [];
        while ($rest > 0) {
            $biggest = $this->stock->biggestFor($rest);
            $coins[] = $biggest;
            $rest -= $biggest;
        }

        return $coins;
    }
}
