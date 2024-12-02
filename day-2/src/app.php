<?php

declare(strict_types=1);

namespace Advent\Day2;

// Initialization
use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;
use ArtemiiKarkusha\Aoc2024\ValuesDiffCalculator;

use function dirname;
use function sprintf;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

$inputDataLinesExtractor = new InputDataLinesExtractor(
    new FileInputGetter(dirname(__DIR__) . '/data/input-data.txt')
);

$reportsExtractor = new ItemsExtractor($inputDataLinesExtractor);
$itemsSafetyIdentifier = new ItemsSafetyIdentifier(new ValuesDiffCalculator());
$reportsSafetyValidator = new ReportsSafetyValidator($itemsSafetyIdentifier);
//----- Initialization


// Main functionality
$startTime = hrtime(true);
$countSafeReports = 0;
$countSafeReportsWithRemovedOneUnsafeItem = 0;

foreach ($reportsExtractor->getItems() as $reportLevels) {
    if ($reportsSafetyValidator->isReportSafe($reportLevels)) {
        $countSafeReports++;
        continue;
    }

    if ($reportsSafetyValidator->isReportSafeWithoutOneUnsafeLevel($reportLevels)) {
        $countSafeReportsWithRemovedOneUnsafeItem++;
    }
}
//----- Main functionality


// Output
echo sprintf(
    'Count Safe Reports: %s. %s',
    $countSafeReports,
    PHP_EOL
);
echo sprintf(
    'Count Safe Reports with removed one unsafe level: %d. %s',
    $countSafeReports + $countSafeReportsWithRemovedOneUnsafeItem,
    PHP_EOL
);

$endTime = hrtime(true);
echo sprintf('Time execution: %s ms %s', ($endTime - $startTime) / 1e6, PHP_EOL);
echo sprintf('Memory Usage: %s', round(memory_get_usage() / 1024)), 'KB' . PHP_EOL;
//----- Output


