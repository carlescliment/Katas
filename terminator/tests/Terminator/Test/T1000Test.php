<?php

namespace Terminator\Test;

use Terminator\T1000;

class T1000Test extends \PHPUnit_Framework_TestCase
{


    /**
     * @test
     */
    public function itCalculatesTheStraightRouteToTarget()
    {
        $route_calculator = $this->getMock('Terminator\Routing\Calculator');
        $legs = $this->getMock('Terminator\Components\Legs');
        $t1000 = new T1000($route_calculator, $legs);
        $target = $this->getMock('Terminator\Entities\Target');

        $route_calculator->expects($this->once())
            ->method('calculate')
            ->with($target);

        $t1000->addTarget($target);
    }


    /**
     * @test
     */
    public function itMovesToTheTargetThroughTheCalculatedRoute()
    {
        $route_calculator = $this->getMock('Terminator\Routing\Calculator');
        $legs = $this->getMock('Terminator\Components\Legs');
        $t1000 = new T1000($route_calculator, $legs);
        $target = $this->getMock('Terminator\Entities\Target');
        $route = $this->getMock('Terminator\Routing\Route');
        $route_calculator->expects($this->any())
            ->method('calculate')
            ->will($this->returnValue($route));

        $legs->expects($this->once())
            ->method('move')
            ->with($route);

        $t1000->addTarget($target);
    }
}