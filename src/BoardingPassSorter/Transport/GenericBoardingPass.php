<?php

namespace BoardingPassSorter\Transport;

/**
 * Class representing a generic boarding pass for a mean of transportation between locations
 */
class GenericBoardingPass
{

    protected $name;
    protected $identifier;
    protected $startingLocation;
    protected $destinationLocation;
    protected $seatNumber;

    public function __construct($name, $identifier, $startingLocation, $destinationLocation, $seatNumber = null)
    {
        $this->name = $name;
        $this->identifier = $identifier;
        $this->startingLocation = $startingLocation;
        $this->destinationLocation = $destinationLocation;
        $this->seatNumber = $seatNumber;
    }

    function getName()
    {
        return $this->name;
    }

    function getIdentifier()
    {
        return $this->identifier;
    }

    function getStartingLocation()
    {
        return $this->startingLocation;
    }

    function getDestinationLocation()
    {
        return $this->destinationLocation;
    }

    function getSeatNumber()
    {
        return $this->seatNumber;
    }
}
