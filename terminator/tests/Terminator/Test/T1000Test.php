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
        $t1000 = new T1000($route_calculator);
        $target = $this->getMock('Terminator\Entities\Target');

        $route_calculator->expects($this->once())
            ->method('calculate')
            ->with($target);

        $t1000->addTarget($target);
    }
}