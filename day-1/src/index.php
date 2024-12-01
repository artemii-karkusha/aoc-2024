<?php

declare(strict_types=1);

namespace Advent\Day1;

use function dirname;
use Symfony\Component\Filesystem\Filesystem;

require_once dirname(__DIR__).'/vendor/autoload.php';

$historiansFinds = (new Filesystem())->readFile(dirname(__DIR__).'/data/historiansInput.txt');
$delimiterForGroups = '   ';

// Convert locations ids of groups to be on same line
$historiansFindsOfLines = explode("\n", $historiansFinds);
$locationsIdsGroups1 = [];
$locationsIdsGroups2 = [];

// Extract locationsIds from finds line
foreach ($historiansFindsOfLines as $historiansFindsOfGroups) {
    list($locationId1, $locationId2) = explode("$delimiterForGroups", $historiansFindsOfGroups);
    $locationsIdsGroups1[] = (int)$locationId1;
    $locationsIdsGroups2[] = (int)$locationId2;
}

function sortValues(array $locationsIds) {
    sort($locationsIds);
    return $locationsIds;
}

function calculateDiffBetweenValues(int $value1, $value2): int
{
    return abs($value1 - $value2);
}

$sortedLocationsIdsGroupd1 = sortValues($locationsIdsGroups1);
$sortedLocationsIdsGroupd2 = sortValues($locationsIdsGroups2);

$countOfLocations = count($historiansFindsOfLines);
$destinationDifference = 0;
for ($i = 0; $i < $countOfLocations; $i++) {
    $destinationDifference+= calculateDiffBetweenValues($sortedLocationsIdsGroupd1[$i], $sortedLocationsIdsGroupd2[$i]);
}

echo 'Destination Difference: ' . $destinationDifference . PHP_EOL;
exit;

