<?php

declare(strict_types=1);

namespace Advent\Day1;

use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;
use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

// Initialization

use function dirname;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

/**
 * @return array
 */
function getLocationsIdsAsGroups(): array
{
    $inputDataLinesExtractor = new InputDataLinesExtractor(
        new FileInputGetter(dirname(__DIR__) . '/data/historiansInput.txt')
    );
    [$locationsIdsGroupd1, $locationsIdsGroupd2] = (new LocationsIdsExtractor(
        $inputDataLinesExtractor
    ))->extractLocations();
    return [$locationsIdsGroupd1, $locationsIdsGroupd2];
}


$destinationCounter = new DestinationCounter(new ArraySorter(), new ValuesDiffCalculator());
$similarityScore = new SimilarityScoreCounter();
//----- Initialization

// Main functionality
[$locationsIdsGroupd1, $locationsIdsGroupd2] = getLocationsIdsAsGroups();

$destinationDifference = $destinationCounter->calculateDestinationDiff($locationsIdsGroupd1, $locationsIdsGroupd2);
$similarityScore = $similarityScore->calculateSimilarityScore($locationsIdsGroupd1, $locationsIdsGroupd2);
//---- Main functionality

echo 'Destination Difference: ' . $destinationDifference . PHP_EOL;
echo 'Similarity Score: ' . $similarityScore . PHP_EOL;
