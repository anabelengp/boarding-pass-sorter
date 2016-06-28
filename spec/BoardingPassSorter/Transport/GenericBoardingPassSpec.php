<?php

namespace spec\BoardingPassSorter\Transport;

use PhpSpec\ObjectBehavior;

class GenericBoardingPassSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("generic", "007", "pointA", "pointB");
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('BoardingPassSorter\Transport\GenericBoardingPass');
    }
}
