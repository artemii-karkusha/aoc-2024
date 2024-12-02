<?php

declare(strict_types=1);

namespace Advent\Day2;

use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;

use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

use function dirname;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

$inputDataLinesExtractor = new InputDataLinesExtractor(
    new FileInputGetter(dirname(__DIR__) . '/data/input-data.txt')
);

$itemsExtractor = new ItemsExtractor($inputDataLinesExtractor);

$countSafeReports = 0;
$itemsSafetyIdentifier = new ItemsSafetyIdentifier(new ValuesDiffCalculator());
foreach ($itemsExtractor->getItems() as $lineItems) {
    if(!$itemsSafetyIdentifier->areItemsSafe($lineItems)){
        continue;
    }

    $countSafeReports++;
}

echo "Count Safe Reports: {$countSafeReports}" . PHP_EOL;