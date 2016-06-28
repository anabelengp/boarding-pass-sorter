<?php

namespace spec\BoardingPassSorter\Collection;

use BoardingPassSorter\Transport\GenericBoardingPass;
use PhpSpec\ObjectBehavior;

class BoardingPassCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BoardingPassSorter\Collection\BoardingPassCollection');
    }
    
    function it_allows_adding_boarding_passes()
    {
        $bp = new GenericBoardingPass("generic", "007", "pointA", "pointB");
        
        $this->count()->shouldReturn(0);
        $this->add($bp);
        $this->count()->shouldReturn(1);   
    }
    
    function it_allows_removing_boarding_passes()
    {
        $bp1 = new GenericBoardingPass("generic", "001", "pointA", "pointB");
        $bp2 = new GenericBoardingPass("generic", "002", "pointA", "pointB");
        
        $this->count()->shouldReturn(0);
        $this->add($bp1);
        $this->add($bp2);
        $this->remove($bp1);
        $this->count()->shouldReturn(1);   
    }
    
    function it_allows_to_add_many_objects_at_a_time()
    {
        $bp1 = new GenericBoardingPass("generic", "001", "pointA", "pointB");
        $bp2 = new GenericBoardingPass("generic", "002", "pointA", "pointB");
        
        $this->count()->shouldReturn(0);
        $this->addAll(array($bp1, $bp2));
        $this->count()->shouldReturn(2);   
    }
    
}
