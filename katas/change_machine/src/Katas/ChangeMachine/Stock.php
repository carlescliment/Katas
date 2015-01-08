<?php

namespace Katas\ChangeMachine;

class Stock
{
    private $coins;

    public function __construct()
    {
        $this->coins = [new Coin(Coins::FIVE_CENTS), new Coin(Coins::TWO_CENTS), new Coin(Coins::ONE_CENT)];
    }

    public function biggestFor($amount)
    {
        return $this->lookupBiggestFor($amount) ?: $this->smallestPossibleCoin();
    }

    private function lookupBiggestFor($amount)
    {
        foreach ($this->coins as $coin) {
            if ($coin->worthsLessOrEqualThan($amount)) {
                return $coin->value();
            }
        }
    }
}
