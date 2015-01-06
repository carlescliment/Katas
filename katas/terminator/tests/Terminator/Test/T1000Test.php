<?php

namespace Terminator\Test;

use Terminator\T1000;

class T1000Test extends \PHPUnit_Framework_TestCase
{

    private $routeCalculator;
    private $legs;
    private $target;
    private $t1000;

    public function setUp()
    {
        $this->target = $this->getMock('Terminator\Entities\Target');
        $this->routeCalculator = $this->getMock('Terminator\Routing\Calculator');
        $this->legs = $this->getMock('Terminator\Components\Legs');
        $this->t1000 = new T1000($this->routeCalculator, $this->legs);
    }


    /**
     * @test
     */
    public function itCalculatesTheStraightRouteToTarget()
    {
        $this->t1000->addTarget($this->target);

        $this->expectCalculatorToReceive($this->target);

        $this->t1000->wakeUp();
    }


    /**
     * @test
     */
    public function itMovesToTheTargetThroughTheCalculatedRoute()
    {
        $this->t1000->addTarget($this->target);
        $route = $this->stubCalculatedRoute();

        $this->expectLegsToReceive($route);

        $this->t1000->wakeUp();
    }


    /**
     * @test
     */
    public function itAttendsManyTargetsInTheOrderTheyWereGiven()
    {
        $this->t1000->addTarget($this->target);
        $this->t1000->addTarget($this->target);
        list($first_route, $second_route) = $this->stubTwoCalculatedRoutes();

        $this->expectLegsToReceiveConsecutively($first_route, $second_route);

        $this->t1000->wakeUp();
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


    private function stubTwoCalculatedRoutes()
    {
        $first_route = $this->getMock('Route');
        $first_route->id = 1;
        $second_route = $this->getMock('Route');
        $second_route->id = 2;
        $this->routeCalculator->expects($this->any())
            ->method('calculate')
            ->will($this->onConsecutiveCalls($first_route, $second_route));
        return array($first_route, $second_route);
    }


    private function expectLegsToReceiveConsecutively($first_route, $second_route)
    {
        $this->legs->expects($this->at(0))
            ->method('move')
            ->with($first_route);
        $this->legs->expects($this->at(1))
            ->method('move')
            ->with($second_route);
    }
}