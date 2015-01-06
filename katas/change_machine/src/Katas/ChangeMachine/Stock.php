<?php

namespace Katas\ChangeMachine;

class Stock
{
    public function biggestFor($amount) {
        $coins = [Coins::FIVE_CENTS, Coins::TWO_CENTS, Coins::ONE_CENT];
        foreach ($coins as $coin) {
            if ($coin <= $amount) {
                return $coin;
            }
        }
        return Coins::ONE_CENT;
    }
}
