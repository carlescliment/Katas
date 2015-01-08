<?php

namespace Katas\ChangeMachine;

class Changer
{
    public function change($total, $stock)
    {
        $rest = $total;
        $coins = [];
        while ($rest > 0) {
            $biggest = $stock->biggestFor($rest);
            $coins[] = $biggest;
            $rest -= $biggest;
        }

        return $coins;
    }
}
