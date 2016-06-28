<?php

namespace spec\BoardingPassSorter\Transport;

use PhpSpec\ObjectBehavior;

class FlightBoardingPassSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("007", "pointA", "pointB", "1A", "G1", "Your luggage will be lost by the operator");
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('BoardingPassSorter\Transport\FlightBoardingPass');
        $this->shouldHaveType('BoardingPassSorter\Transport\GenericBoardingPass');
    }
}
