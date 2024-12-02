<?php

declare(strict_types=1);

namespace Advent\Day1;

use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;
use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

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
    list($locationsIdsGroupd1, $locationsIdsGroupd2) = (new LocationsIdsExtractor(
        $inputDataLinesExtractor
    ))->extractLocations();
    return [$locationsIdsGroupd1, $locationsIdsGroupd2];
}


$destinationCounter = new DestinationCounter(new ArraySorter(), new ValuesDiffCalculator());
$similarityScore = new SimilarityScoreCounter();

list($locationsIdsGroupd1, $locationsIdsGroupd2) = getLocationsIdsAsGroups();

$destinationDifference = $destinationCounter->calculateDestinationDiff($locationsIdsGroupd1, $locationsIdsGroupd2);

$similarityScore = $similarityScore->calculateSimilarityScore($locationsIdsGroupd1, $locationsIdsGroupd2);

echo 'Destination Difference: ' . $destinationDifference . PHP_EOL;
echo 'Similarity Score: ' . $similarityScore . PHP_EOL;