<?php

namespace BoardingPassSorter\Sorter;

use BoardingPassSorter\Collection\BoardingPassCollection;
use BoardingPassSorter\Transport\GenericBoardingPass;
use Exception;

/**
 * Class responsible for sorting the chain of given BoardingPasses in an order
 * transport should be executed
 */
class BoardingPassSorter
{

    /**
     * Given an array of GenericBoardingPass instances, it returns an
     * array sorted by order in which locations are visited in a chain
     *
     * @param BoardingPassCollection $boardingPasses
     * @param BoardingPassCollection $resultingBoardingPassChain optional collection to append the sorted list to
     *
     * @return BoardingPassCollection sorted list of GenericBoardingPass instances
     */
    public function sortBoardingPassCollection(
        BoardingPassCollection $boardingPasses,
        BoardingPassCollection $resultingBoardingPassChain = null
    ) {
        /* @var $startingBoardingPass GenericBoardingPass */
        $startingBoardingPass = null;
        /* @var $destinationBoardingPass GenericBoardingPass */
        $destinationBoardingPass = null;
        /* @var $destinationBoardingPass GenericBoardingPass */
        $currentBoardingPass = null;

        $resultingBoardingPassChain = new BoardingPassCollection();

        $locations = $this->parseLocations($boardingPasses->getArray());

        foreach ($locations as $data) {
            if ($data['start'] === null) {
                $destinationBoardingPass = $data['end'];
            } elseif ($data['end'] === null) {
                $startingBoardingPass = $data['start'];
            }
        }

        $resultingBoardingPassChain->add($startingBoardingPass);
        $currentBoardingPass = $startingBoardingPass;

        do {
            $currentBoardingPass = $locations[$currentBoardingPass->getDestinationLocation()]['start'];
            $resultingBoardingPassChain->add($currentBoardingPass);
        } while ($currentBoardingPass !== $destinationBoardingPass);

        return $resultingBoardingPassChain;
    }

    /**
     * For a given array of BoardingPass objects, it return an array of
     * locations and BoardingPasses leading to/from them as a dictionary
     * in format:
     *
     * array(
     *      'locationName' => array(
     *          'start' => BoaringPass,
     *          'end' => BoardingPass
     *      ),
     *      ...
     * )
     *
     * @param array $boardingPasses
     * @return array
     * @throws Exception
     */
    protected function parseLocations(array $boardingPasses)
    {
        $locations = array();

        /* @var $boardingPass GenericBoardingPass */
        foreach ($boardingPasses as $boardingPass) {
            $startLocation = $boardingPass->getStartingLocation();

            if (!isset($locations[$startLocation])) {
                $locations[$startLocation] = array('start' => null, 'end' => null);
            }

            if ($locations[$startLocation]['start'] !== null) {
                throw new Exception(
                    "At least two boarding passes starting in $startLocation we don't expect go back to the same place again"
                );
            }

            $locations[$startLocation]['start'] = $boardingPass;

            $destinationLocation = $boardingPass->getDestinationLocation();

            if (!isset($locations[$destinationLocation])) {
                $locations[$destinationLocation] = array('start' => null, 'end' => null);
            }

            if ($locations[$destinationLocation]['end'] !== null) {
                throw new Exception(
                    "At least two boarding passes ending in $destinationLocation we don't expect go back to the same place again"
                );
            }

            $locations[$destinationLocation]['end'] = $boardingPass;
        }

        return $locations;
    }
}
