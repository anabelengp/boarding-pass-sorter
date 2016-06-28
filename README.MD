README
==============

Problem to solve
----------------

You are given a stack of boarding cards for various transportations that will take you from a point A to point B via several stops on the way. All of the boarding cards are out of order and you don't know where your journey starts, nor where it ends. Each boarding card contains information about seat assignment, and means of transportation (such as flight number, bus number etc).

Write an API that lets you sort this kind of list and present back a description of how to complete your journey.

For instance the API should be able to take an unordered set of boarding cards, provided in a format defined by you, and produce this list:

    Take train 78A from Madrid to Barcelona. Sit in seat 45B.
    Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
    From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
    Baggage drop at ticket counter 344.
    From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
    Baggage will we automatically transferred from your last leg.
    You have arrived at your final destination.

The list should be defined in a format that's compatible with the input format. The API is to be an internal PHP API so it will only communicate with other parts of a PHP application, not server to server, nor server to client. Use PHP-doc to document the input and output your API accepts / returns.

Installation
------------

Use composer to install the dependencies

    composer install

Usage
-----

To use the API to sort a list, one has to create an instance of ```BoardingPassSorter\Sorter\BoardingPassSorter``` and use it to sort and instance of ```BoardingPassSorter\Collection\BoardingPassCollection``` which is a data structure holding a list of ```BoardingPassSorter\Transport\GenericBoardingPass```.

An example execution might look like:

    $boardingPassSorter = new BoardingPassSorter();
    $collection = new BoardingPassCollection();

    $boardAB = new GenericBoardingPass("generic", "007", "pointA", "pointB");
    $boardBC = new GenericBoardingPass("generic", "007", "pointB", "pointC");
    $boardCD = new GenericBoardingPass("generic", "007", "pointC", "pointD");
    $boardDE = new GenericBoardingPass("generic", "007", "pointD", "pointE");

    $collection->addAll(array($boardBC, $boardAB, $boardDE, $boardCD));

    $sortedCollection = $boardingPassSorter->sortBoardingPassCollection($collection);

As a result we get an instance of ```BoardingPassCollection``` containing boarding passes sorted in order, one can access the list by calling ```getArray()``` on an instance of the class.

See the ```example.php``` file.

Tests
-----

Tests were written using __phpspec__. To run the test set just execute:

``` 
./bin/phpspec run -f pretty
```

Extending
---------

To add new definitions of boarding cards for new types of transportation, it is enough to create a class extending ```BoardingPassSorter\Transport\GenericBoardingPass```,
and define additional fields/methods there as seen in ```BoardingPassSorter\Transport\FlightBoardingPass```.

Assumptions made
----------------

Task doesn't specify how to deal with cycles in the chain, assumed that a list of passes going A -> B -> A -> D is wrong.

Author
------

Bartłomiej Wach

bartlomiej.wach@yahoo.pl

skype: cozmo888
