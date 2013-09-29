<?php

namespace Terminator\Test;

use Terminator\T1000;

class T1000Test extends \PHPUnit_Framework_TestCase
{

    private $routeCalculator;
    private $legs;
    private $t1000;

    public function setUp()
    {
        $this->routeCalculator = $this->getMock('Terminator\Routing\Calculator');
        $this->legs = $this->getMock('Terminator\Components\Legs');
        $this->t1000 = new T1000($this->routeCalculator, $this->legs);
    }


    /**
     * @test
     */
    public function itCalculatesTheStraightRouteToTarget()
    {
        $target = $this->getMock('Terminator\Entities\Target');

        $this->expectCalculatorToReceive($target);

        $this->t1000->addTarget($target);
    }


    /**
     * @test
     */
    public function itMovesToTheTargetThroughTheCalculatedRoute()
    {
        $target = $this->getMock('Terminator\Entities\Target');
        $route = $this->stubCalculatedRoute();

        $this->expectLegsToReceive($route);

        $this->t1000->addTarget($target);
    }


    private function stubCalculatedRoute()
    {
        $route = $this->getMock('Terminator\Routing\Route');
        $this->routeCalculator->expects($this->any())
            ->method('calculate')
            ->will($this->returnValue($route));
        return $route;
    }


    private function expectCalculatorToReceive($target)
    {
        $this->routeCalculator->expects($this->once())
            ->method('calculate')
            ->with($target);
    }

    private function expectLegsToReceive($route)
    {
        $this->legs->expects($this->once())
            ->method('move')
            ->with($route);
    }
}