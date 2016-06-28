<?php

namespace spec\BoardingPassSorter\Sorter;

use BoardingPassSorter\Collection\BoardingPassCollection;
use BoardingPassSorter\Transport\GenericBoardingPass;
use PhpSpec\ObjectBehavior;

class BoardingPassSorterSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('BoardingPassSorter\Sorter\BoardingPassSorter');
    }

    function it_sorts_list_of_generic_boarding_passes()
    {
        $collection = new BoardingPassCollection();
        $resultingCollection = new BoardingPassCollection();

        $boardAB = new GenericBoardingPass("generic", "007", "pointA", "pointB");
        $boardBC = new GenericBoardingPass("generic", "007", "pointB", "pointC");
        $boardCD = new GenericBoardingPass("generic", "007", "pointC", "pointD");
        $boardDE = new GenericBoardingPass("generic", "007", "pointD", "pointE");

        $collection->addAll(array($boardBC, $boardAB, $boardDE, $boardCD));

        $this->sortBoardingPassCollection($collection, $resultingCollection)->shouldReturnASortedList(array($boardAB, $boardBC, $boardCD, $boardDE));
    }
    
    function it_throws_an_exception_if_two_boarding_passes_lead_to_the_same_location()
    {
        $collection = new BoardingPassCollection();

        $boardAB = new GenericBoardingPass("generic", "007", "pointA", "pointB");
        $boardBC = new GenericBoardingPass("generic", "007", "pointB", "pointC");
        $boardCD = new GenericBoardingPass("generic", "007", "pointC", "pointB");
        $boardDE = new GenericBoardingPass("generic", "007", "pointD", "pointE");

        $collection->addAll(array($boardBC, $boardAB, $boardDE, $boardCD));

        $this->shouldThrow("\\Exception")->duringSortBoardingPassCollection($collection);
    }
    
    function it_throws_an_exception_if_two_boarding_passes_start_in_the_same_location()
    {
        $collection = new BoardingPassCollection();

        $boardAB = new GenericBoardingPass("generic", "007", "pointA", "pointB");
        $boardBC = new GenericBoardingPass("generic", "007", "pointB", "pointC");
        $boardCD = new GenericBoardingPass("generic", "007", "pointA", "pointD");
        $boardDE = new GenericBoardingPass("generic", "007", "pointD", "pointE");

        $collection->addAll(array($boardBC, $boardAB, $boardDE, $boardCD));

        $this->shouldThrow("\\Exception")->duringSortBoardingPassCollection($collection);
    }


    public function getMatchers()
    {
        return [
            'returnASortedList' => function (BoardingPassCollection $subject, array $list) {
                return $subject->getArray() == $list;
            }
        ];
    }
}
