<?php

namespace Terminator;

use Terminator\Routing\Calculator;
use Terminator\Entities\Target;
use Terminator\Components\Legs;

class T1000
{
    private $routeCalculator;
    private $legs;
    private $targets = array();

    public function __construct(Calculator $route_calculator, Legs $legs)
    {
        $this->routeCalculator = $route_calculator;
        $this->legs = $legs;
    }


    public function addTarget(Target $target)
    {
        $this->targets[] = $target;
    }


    public function wakeUp()
    {
        foreach ($this->targets as $target)
        {
            $this->processTarget($target);
        }
    }


    private function processTarget($target)
    {
        $route = $this->routeCalculator->calculate($target);
        $this->legs->move($route);
    }
}