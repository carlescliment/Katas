<?php

namespace Katas\ChangeMachine;

class Coin
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function worthsLessOrEqualThan($amount)
    {
        return $this->value <= $amount;
    }

    public function value()
    {
        return $this->value;
    }
}
