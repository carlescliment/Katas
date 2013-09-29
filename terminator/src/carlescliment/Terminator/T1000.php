<?php

namespace Terminator;

use Terminator\Routing\Calculator;
use Terminator\Entities\Target;

class T1000
{
    private $routeCalculator;


    public function __construct(Calculator $route_calculator)
    {
        $this->routeCalculator = $route_calculator;
    }


    public function addTarget(Target $target)
    {
        $this->routeCalculator->calculate($target);
    }
}