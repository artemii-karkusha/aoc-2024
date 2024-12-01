<?php

declare(strict_types=1);

namespace Advent\Day1;

use function dirname;

require_once dirname(__DIR__).'/vendor/autoload.php';

$destinationCounter = new DestinationCounter(new ArraySorter());
$similarityScore = new SimilarityScoreCounter();

$locationExtractor = new LocationsIdsExtractor(new FileInputGetter());

list($locationsIdsGroupd1, $locationsIdsGroupd2) = $locationExtractor->extractLocations();

$destinationDifference = $destinationCounter->calculateDestinationDiff($locationsIdsGroupd1, $locationsIdsGroupd2);

$similarityScore = $similarityScore->calculateSimilarityScore($locationsIdsGroupd1, $locationsIdsGroupd2);

echo 'Destination Difference: ' . $destinationDifference . PHP_EOL;
echo 'Similarity Score: ' . $similarityScore . PHP_EOL;