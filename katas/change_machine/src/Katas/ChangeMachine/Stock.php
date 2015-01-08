<?php

namespace Katas\ChangeMachine;

class Stock
{
    public function biggestFor($amount)
    {
        $biggest_possible_coin = $this->lookupBiggestFor($amount);

        return $biggest_possible_coin ?: $this->smallerPossibleCoin();
    }

    private function lookupBiggestFor($amount)
    {
        $coins = [new Coin(Coins::FIVE_CENTS), new Coin(Coins::TWO_CENTS), new Coin(Coins::ONE_CENT)];
        foreach ($coins as $coin) {
            if ($coin->value() <= $amount) {
                return $coin->value();
            }
        }

        return null;
    }

    private function smallerPossibleCoin()
    {
        $lower = new Coin(Coins::ONE_CENT);

        return $lower->value();
    }
}
