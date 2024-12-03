<?php

declare(strict_types=1);

namespace Advent\Day3;

//----- Initialization
use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;

use function dirname;
use function sprintf;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

$startTime = hrtime(true);
$inputDataLinesExtractor = new InputDataLinesExtractor(
    new FileInputGetter(dirname(__DIR__) . '/data/input-data.txt')
);

$mulsExtractor = new MulsExtractor($inputDataLinesExtractor);
$mulsMultiplier = new MulMultiplier();
//----- Initialization


//----- Main functionality

$resultOfTheMultiplications = 0;
foreach ($mulsExtractor->getAllMuls() as $mul) {
    $resultOfTheMultiplications += $mulsMultiplier->getMultipliedResult($mul);
}

$resultOfTheMultiplicationsForEnabledCode = 0;
foreach ($mulsExtractor->getEnabledMuls() as $mul) {
    $resultOfTheMultiplicationsForEnabledCode += $mulsMultiplier->getMultipliedResult($mul);
}


//----- Main functionality


$mulsExtractor->getEnabledMuls();

// Output
echo sprintf(
    'Results of the multiplications: %s. %s',
    $resultOfTheMultiplications,
    PHP_EOL
);
echo sprintf(
    'Results of the multiplications for enabled code: %s. %s',
    $resultOfTheMultiplicationsForEnabledCode,
    PHP_EOL
);

$endTime = hrtime(true);
echo sprintf('Time execution: %s ms %s', ($endTime - $startTime) / 1e6, PHP_EOL);
echo sprintf('Memory Usage: %s', round(memory_get_usage() / 1024)), 'KB' . PHP_EOL;
//----- Output


