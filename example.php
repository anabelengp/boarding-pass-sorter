<?php

require_once __DIR__ . '/vendor/autoload.php';

use BoardingPassSorter\Sorter\BoardingPassSorter;
use BoardingPassSorter\Transport\GenericBoardingPass;
use BoardingPassSorter\Collection\BoardingPassCollection;

$boardingPassSorter = new BoardingPassSorter();
$collection = new BoardingPassCollection();

$boardAB = new GenericBoardingPass("generic", "007", "pointA", "pointB");
$boardBC = new GenericBoardingPass("generic", "007", "pointB", "pointC");
$boardCD = new GenericBoardingPass("generic", "007", "pointC", "pointD");
$boardDE = new GenericBoardingPass("generic", "007", "pointD", "pointE");

$collection->addAll(array($boardBC, $boardAB, $boardDE, $boardCD));

$sortedCollection = $boardingPassSorter->sortBoardingPassCollection($collection);

var_dump($sortedCollection);