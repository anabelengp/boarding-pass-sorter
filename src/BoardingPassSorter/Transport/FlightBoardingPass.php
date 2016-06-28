<?php

namespace BoardingPassSorter\Transport;

/**
 * Class representing a flight boarding pass
 */
class FlightBoardingPass extends GenericBoardingPass
{

    protected $gateNumber;
    protected $baggageInfo;

    public function __construct($identifier, $startingLocation, $destinationLocation, $seatNumber, $gateNumber, $baggageInfo)
    {
        parent::__construct("flight", $identifier, $startingLocation, $destinationLocation, $seatNumber);

        $this->gateNumber = $gateNumber;
        $this->baggageInfo = $baggageInfo;
    }

    function getGateNumber()
    {
        return $this->gateNumber;
    }

    function getBaggageInfo()
    {
        return $this->baggageInfo;
    }

    function setGateNumber($gateNumber)
    {
        $this->gateNumber = $gateNumber;
    }

    function setBaggageInfo($baggageInfo)
    {
        $this->baggageInfo = $baggageInfo;
    }
}
