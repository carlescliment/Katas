<?php

namespace Katas\ChangeMachine;

class Coins
{
    const ONE_CENT = '0.01';
    const TWO_CENTS = '0.02';
    const FIVE_CENTS = '0.05';

    public static function biggestFor($amount) {
        $coins = [self::FIVE_CENTS, self::TWO_CENTS, self::ONE_CENT];
        foreach ($coins as $coin) {
            if ($coin <= $amount) {
                return $coin;
            }
        }
        return self::ONE_CENT;
    }
}
