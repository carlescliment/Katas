<?php

namespace Katas\ChangeMachine;

class Stock
{
    private $coins;

    public function __construct(array $coins)
    {
        $this->coins = $coins;
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
