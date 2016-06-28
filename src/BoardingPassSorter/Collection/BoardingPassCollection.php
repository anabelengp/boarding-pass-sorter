<?php

namespace BoardingPassSorter\Collection;

use BoardingPassSorter\Transport\GenericBoardingPass;

/**
 * Class representing a collection of GenericBoardingPass instances
 */
class BoardingPassCollection
{
    protected $boardingPasses;
    
    public function __construct()
    {
        $this->boardingPasses = array();
    }
    
    /**
     * Adds an instance of GenericBoardingPass to the list
     * 
     * @param GenericBoardingPass $boardingPass
     */
    public function add(GenericBoardingPass $boardingPass)
    {
        $this->boardingPasses[] = $boardingPass;
    }
    
    /**
     * Removes a GenericBoardingPass from the list
     * 
     * @param GenericBoardingPass $boardingPass
     */
    public function remove(GenericBoardingPass $boardingPass)
    {
        foreach($this->boardingPasses as $key => $collectionBoardingPass)
        {
            if($collectionBoardingPass === $boardingPass)
            {
                unset($this->boardingPasses[$key]);
            }
        }
    }
    
    /**
     * Returns the inner kept array of objects
     * 
     * @return array
     */
    public function getArray()
    {
        return $this->boardingPasses;
    }

    /**
     * Returns the count of kept objects
     * 
     * @return int
     */
    public function count()
    {
        return count($this->boardingPasses);
    }

    /**
     * Adds the listed objects to internal list
     * 
     * @param array $boardingPassArray
     */
    public function addAll(array $boardingPassArray)
    {
        foreach($boardingPassArray as $newBoardingPass)
        {
            $this->add($newBoardingPass);
        }
    }
}
